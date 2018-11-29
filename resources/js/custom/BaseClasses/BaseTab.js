import Listeners from "../Utils/Listeners.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";
import UtilityBlocks from "../Utils/UtilityBlocks.js";
import TabsConfig from "../Config/TabsConfig.js";
import { simpleAjaxPromise } from "../Api/Multi.js";
import { tabContentIdJQ, apiMethods, toasterMessages } from "../Config/Constants.js";
import ConformationModal from "../Modals/ConformationModal.js";
import InfoModal from "../Modals/InfoModal.js";
import User from "../Utils/User.js";

class BaseTab {
    constructor () {
        this.config = TabsConfig.values[this.constructor.name];
        this.template = '';
        this.listeners = {};
        this.edit = {
            'modelId': null,
            'state': false,
        };
        this.additionlClassesJQ = {};
        this.additions = {};
        this.utilityBlocksInfo = {};
        this.validation = {};
        this.searchOptions = {};
        this.premisions = {
            isLoggedIn: User.isLoggedIn,
        }
    }

    checkPermissions (action) {
        if (!this.premisions.hasOwnProperty(action)) {
            this.premisions = Object.assign(this.premisions, {
                [action]: User.checkPermissions(action + '_' + this.config.backendPremissionModelName)
            });
        }
        return this.premisions[action];
    }

    getModels () {
        if (this.config.pagination) {
            return simpleAjaxPromise(apiMethods.get, this.config.api.base, this.config.pagination.params);
        } else {
            return simpleAjaxPromise(apiMethods.get, this.config.api.base);
        }
    }

    updateModels (models) {
        return simpleAjaxPromise(apiMethods.update, this.config.api.updateCreate, models);
    }

    createModels (models) {
        return simpleAjaxPromise(apiMethods.create, this.config.api.updateCreate, models);
    }

    deleteModel (modelId) {
        return simpleAjaxPromise(apiMethods.delete, this.config.api.delete + modelId);
    }

    saveModel (modelId) {}

    saveOneModel (modelId) {
        if (modelId === 'new') {
            this.edit.new = this.getNewEditStateModel();
            this.validateEditState('new', this.edit.new);
            if (this.validation.hasOwnProperty('new')) {
                this.rerender();
            } else {
                this.createModels(this.edit.new)
                .then((response) => {
                    this.edit = {
                        'modelId': null,
                        'state': false,
                    };
                    this.models = Object.assign(this.models, {[response.data.id]: response.data});
                    toastr.success(toasterMessages.success.save);
                }, function (error) {
                    toastr.error(toasterMessages.error.save);
                }).then(() => {
                    this.rerender();
                });
            }
        } else {
            var models = this.getMergedEditStateModels();
            if (this.validation.hasOwnProperty(modelId)) {
                this.rerender();
            } else {
                if (models.length > 0) {
                    this.updateModels(models)
                    .then((response) => {
                        this.edit = {
                            'modelId': null,
                            'state': false,
                        };
                        this.models[modelId] = response.data[0];
                        toastr.success(toasterMessages.success.update);
                    }, function (error) {
                        toastr.error(toasterMessages.error.update);
                    }).then(() => {
                        this.rerender();
                    });
                } else {
                    toastr.warning(toasterMessages.warning.nothingToSave);
                }
            }
        }
    }

    saveAllModels () {
        var arrayOfPromises = [],
            models = this.getMergedEditStateModels();

        if (this.edit.hasOwnProperty('new')) {
            this.edit.new = this.getNewEditStateModel()
            this.validateEditState('new', this.edit.new);
            if (jQuery.isEmptyObject(this.validation)) {
                arrayOfPromises.push(
                    this.createModels({0 : this.edit.new})
                    .then((response) => {
                        this.models = Object.assign(this.models, {[response.data.id]: response.data[0]});
                        toastr.success(toasterMessages.success.save);
                    }, function (error) {
                        toastr.error(toasterMessages.error.save);
                    })
                );
            }
        }

        if (jQuery.isEmptyObject(this.validation) && models.length > 0) {
            arrayOfPromises.push(
                this.updateModels(models)
                .then((response) => {
                    for (var responseId in response.data) {
                        for (var modelId in this.models) {
                            if (response.data[responseId].id === this.models[modelId].id) {
                                this.models[modelId] = response.data[responseId];
                                continue;
                            }
                        }
                    }
                    toastr.success(toasterMessages.success.update);
                }, function (error) {
                    toastr.error(toasterMessages.error.update);
                })
            );
        }

        if (arrayOfPromises.length > 0 && jQuery.isEmptyObject(this.validation)) {
            $.when.apply(null, arrayOfPromises).done(() => {
                this.edit = {
                    'modelId': null,
                    'state': false,
                };
                this.rerender();
            });
        } else if (!jQuery.isEmptyObject(this.validation)) {
            this.rerender();
        } else {
            toastr.warning(toasterMessages.warning.nothingToSave);
        }
    }

    removeModel (modelId) {
        this.utilityBlocksInfo['confirmation-delete-model'].continue = () => {
            console.log(modelId);
            if (this.models.hasOwnProperty(modelId)) {
                this.deleteModel(this.models[modelId].id)
                .then((response) => {
                    if (this.edit.hasOwnProperty(modelId)) {
                        delete this.edit[modelId];
                    }
                    $('#' + modelId).remove();
                    delete this.models[modelId];
                    delete this.edit[modelId];
                    delete this.validation[modelId];
                    this.rerender();
                    toastr.success(toasterMessages.success.delete);
                }, function (error) {
                    toastr.error(toasterMessages.error.delete);
                });
            } else {
                $('#' + modelId).remove();
                delete this.edit[modelId];
                delete this.validation[modelId];
            }
        };
        this.utilityBlocksInfo['confirmation-delete-model'].open();
    }

    cancelEditing () {
        this.edit = {
            'modelId': null,
            'state': false,
        };
        this.rerender();
    }

    enterEditing (modelId) {
        if (this.config.extraBlocks.includes('confirmation-edit-next-model') && this.edit.state) {
            this.utilityBlocksInfo['confirmation-edit-next-model'].continue = () => {
                this.edit = {
                    'modelId': modelId,
                    'state': true,
                }
                this.rerender();
            };
            this.utilityBlocksInfo['confirmation-edit-next-model'].open();
        } else {
            this.edit = {
                'modelId': modelId,
                'state': true,
            }
            this.rerender();
        }
    }

    cancelEditingModal () {
        this.edit = {
            'modelId': null,
            'state': false,
        }
    }

    enterEditingModal (modelId) {
        this.edit = {
            'modelId': modelId,
            'state': true,
        }
    }

    setData (response) {
        this.models = response;
    }

    makeTemplate (response) {}

    getBaseContainer (content) {
        return `<div class="container">
            <div  class="row justify-content-center">
                ${content}
            </div>
        </div>`;
    }

    getBaseContainerFullWidth (content) {
        return `<div  class="row justify-content-center">
            ${content}
        </div>`;
    }

    mergeUtilityBlocksInfo (object) {
        UtilityBlocks.merge(this.utilityBlocksInfo, object);
    }

    makeUtilityBlocks () {
        var extraBlocks = '',
            block = null;

        for (var extraBlockName in this.config.extraBlocks) {
            switch (this.config.extraBlocks[extraBlockName]) {
                case 'info-show-help-model':
                    block = new InfoModal(this.constructor.name, 'show-help-model', 'help');
                    block.init();
                    this.mergeUtilityBlocksInfo(block.getUtilityBlockInfo());
                    this.addListeners(block.getListeners());
                    break;
                case 'confirmation-delete-model':
                    block = new ConformationModal(this.constructor.name, 'delete-model');
                    block.init();
                    this.mergeUtilityBlocksInfo(block.getUtilityBlockInfo());
                    this.addListeners(block.getListeners());
                    break;
                case 'confirmation-edit-next-model':
                    var block = new ConformationModal(this.constructor.name, 'edit-next-model');
                    block.init();
                    this.mergeUtilityBlocksInfo(block.getUtilityBlockInfo());
                    this.addListeners(block.getListeners());
                    break;
            }
            extraBlocks += block.getTemplate();
        }

        this.template = this.template.concat(extraBlocks);
    }

    showHelp () {
        this.utilityBlocksInfo['info-show-help-model'].open();
    }

    getMergedSearchOptions (offset, limit) {
        if (offset !== undefined && limit !== undefined) {
            return Object.assign({}, {
                'offset': offset,
                'limit': limit,
            }, this.searchOptions);
        } else {
            return Object.assign({}, this.config.pagination.params, this.searchOptions)
        }
    }

    paginationMove (offset, limit) {
        simpleAjaxPromise(apiMethods.get, this.config.api.base, this.getMergedSearchOptions(offset, limit))
        .then((response) => {
            this.config.pagination.params.offset = offset;
            if (response.data.length != limit) {
                this.config.pagination.hasMore = false;
            } else {
                this.config.pagination.hasMore = true;
            }
            this.setData(response.data);
            this.rerender();
        }, (error) => {
            toastr.error(toasterMessages.error.noData);
        });
    }

    searchModels (query) {
        if (query) {
            this.config.pagination.params.offset = 0;
            this.searchOptions = {
                'q': query,
            };
        } else {
            delete this.searchOptions.q;
        }

        simpleAjaxPromise(apiMethods.get, this.config.api.base, this.getMergedSearchOptions())
        .then((response) => {
            this.config.pagination.params.offset = 0;
            if (response.data.length != this.config.pagination.params.limit) {
                this.config.pagination.hasMore = false;
            } else {
                this.config.pagination.hasMore = true;
            }
            this.setData(response.data);
            this.rerender();
        }, (error) => {
            toastr.error(toasterMessages.error.noData);
        });
    }

    setListeners (type, listenerObj) {
        Listeners.set(this, type, listenerObj);
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    initListeners () {
        Listeners.init(this);
    }

    addToEditState (modelId, type, object) {
        if (this.edit.hasOwnProperty(modelId)) {
            if (this.edit[modelId].hasOwnProperty(type)) {
                this.edit[modelId][type] = Object.assign(this.edit[modelId][type], object);
            } else {
                this.edit[modelId][type] = object;
            }
        } else {
            this.edit[modelId] = {
                [type]: object
            };
        }
        console.log(this.edit);
    }

    removeFromEditState (modelId, type, typeId) {
        if (this.edit.hasOwnProperty(modelId) &&
            this.edit[modelId].hasOwnProperty(type) &&
            this.edit[modelId][type].hasOwnProperty(typeId)) {
            delete this.edit[modelId][type][typeId];
        }
        console.log(this.edit);
    }

    updateEditState (modelId, type, value) {
        if (this.edit.hasOwnProperty(modelId)) {
            this.edit[modelId][type] = value;
        } else {
            this.edit[modelId] = {
                [type]: value
            };
        }
        console.log(this.edit);
    }

    validateEditState (modelId, model) {console.log(model);
        for (var fieldName in model) {
            for (var validationIndex in this.config.validation) {
                switch (validationIndex) {
                    case 'notNull':
                        if (this.config.validation.notNull.fieldNames.includes(fieldName) && (model[fieldName] !== 0 && !model[fieldName])) {
                            this.validationAssigne(modelId, fieldName, this.config.validation.notNull.errorMsg);
                        } else {
                            this.validationRemove(modelId, fieldName, this.config.validation.notNull.errorMsg);
                        }
                        break;
                    case 'regexSuccess':
                        if (this.config.validation.regexSuccess.hasOwnProperty(fieldName)) {
                            var reg = new RegExp(this.config.validation.regexSuccess[fieldName].regex, this.config.validation.regexSuccess[fieldName].flags),
                                match = reg.exec(model[fieldName]);

                            if (!match) {
                                this.validationAssigne(modelId, fieldName, this.config.validation.regexSuccess[fieldName].errorMsg);
                            } else {
                                this.validationRemove(modelId, fieldName, this.config.validation.regexSuccess[fieldName].errorMsg);
                            }
                        }
                        break;
                    case 'regexFailed':
                        if (this.config.validation.regexFailed.hasOwnProperty(fieldName)) {
                            var reg = new RegExp(this.config.validation.regexFailed[fieldName].regex, this.config.validation.regexFailed[fieldName].flags),
                                match = reg.exec(model[fieldName]);

                            if (match) {
                                this.validationAssigne(modelId, fieldName, this.config.validation.regexFailed[fieldName].errorMsg);
                            } else {
                                this.validationRemove(modelId, fieldName, this.config.validation.regexFailed[fieldName].errorMsg);
                            }
                        }
                        break;
                }
            }
        }
    }

    validationRemove (modelId, fieldName, errorMsg) {
        if (this.validation.hasOwnProperty(modelId) &&
            this.validation[modelId].hasOwnProperty(fieldName) &&
            this.validation[modelId][fieldName].errorMsg == errorMsg) {
            delete this.validation[modelId][fieldName];
            if (jQuery.isEmptyObject(this.validation[modelId])) {
                delete this.validation[modelId];
            }
        }
    }

    validationAssigne (modelId, fieldName, errorMsg) {
        if (this.validation.hasOwnProperty(modelId)) {
            if (!this.validation[modelId].hasOwnProperty(fieldName)) {
                this.validation[modelId] = Object.assign({}, this.validation[modelId], {
                    [fieldName]: errorMsg
                });
            }
        } else {
            this.validation = Object.assign({}, this.validation, {
                [modelId]: {
                    [fieldName]: errorMsg
                }
            });
        }
    }

    getValidatedObject (modelId) {
        var errorModel = this.getMergedEditStateModel(modelId),
            errorValidation = this.validation[modelId];

        delete this.validation[modelId];

        return {
            'errorModel': errorModel,
            'errorValidation': errorValidation,
        };
    }

    getMergedEditStateModels () {
        var results = [];
        for (var modelId in this.edit) {
            if (this.models.hasOwnProperty(modelId)) {
                var mergedModel = this.getMergedEditStateModel(modelId);
                this.validateEditState(modelId, mergedModel);
                results.push(mergedModel);
            }
        }
        return results;
    }

    getMergedEditStateModel (modelId) {
        return Object.assign({}, this.models[modelId], this.edit[modelId]);
    }

    getNewEditStateModel () {
        return Object.assign({}, this.config.defaultEditState, this.edit.new);
    }

    mergeAdditionlClassesJQ (object) {
        AdditionlClassesJQ.merge(this.additionlClassesJQ, object);
    }

    addAdditionlClassesJQ (modelId, classVar) {
        AdditionlClassesJQ.add(this.additionlClassesJQ, modelId ,classVar);
        this.addListeners(classVar.getListeners());
    }

    initAdditionlClassesJQ () {
        AdditionlClassesJQ.init(this.additionlClassesJQ);
        if (this.edit.modelId) {
            if (!jQuery.isEmptyObject(this.validation)) {
                this.edit = {
                    'modelId': this.edit.modelId,
                    'state': true,
                }
            }
        } else {
            this.edit = {
                'modelId': null,
                'state': false,
            }
        }
    }

    getAdditions () {
        var arrayOfPromises = [];
        if (this.config.hasOwnProperty('getAdditions')) {
            for (let addition in this.config.getAdditions) {
                arrayOfPromises.push(
                    simpleAjaxPromise(apiMethods.get, this.config.getAdditions[addition])
                    .then((response) => {
                        this.additions[addition] = response.data;
                    }, function (error) {
                        toastr.error(toasterMessages.error.noData);
                    })
                );
            }
        }
        return arrayOfPromises;
    }

    renderTemplate () {
        $(tabContentIdJQ).html(this.template);
    }

    init () {
        $.when.apply(null, this.getAdditions()).done(() => {
            this.getModels()
            .then((response) => {
                this.setData(response.data);
                this.makeTemplate();
                this.makeUtilityBlocks();
                this.renderTemplate();
                this.initListeners();
                this.initAdditionlClassesJQ();
            }, (error) => {
                $(tabContentIdJQ).empty();
                toastr.error(toasterMessages.error.noData);
            })
            .then(function () {
                mApp.unblockPage();
            });
        });
    }

    rerender () {
        mApp.blockPage();
        $('body').css('padding-right','0px')
        $('.modal-backdrop').remove();
        new Promise((resolve) => {
            this.makeTemplate();
            this.makeUtilityBlocks();
            this.renderTemplate();
            this.initListeners();
            this.initAdditionlClassesJQ();
            resolve();
        }).then(function () {
            mApp.unblockPage();
        });
    }
}
export default BaseTab