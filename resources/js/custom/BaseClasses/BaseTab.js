import Listeners from "../Utils/Listeners.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";
import UtilityBlocks from "../Utils/UtilityBlocks.js";
import TabsConfig from "../Config/TabsConfig.js";
import { simpleAjaxPromise } from "../Api/Multi.js";
import { tabContentIdJQ, apiMethods, toastrMessages } from "../Config/Constants.js";
import ConformationModal from "../Modals/ConformationModal.js";
import InfoModal from "../Modals/InfoModal.js";
import User from "../Utils/User.js";
import SettingsDB from "../Utils/SettingsDB";
import Storage from "../Utils/Storage.js";

class BaseTab {
    constructor () {
        this.config = {}
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
        this.pagination = null;
        this.premissions = {
            isLoggedIn: User.isLoggedIn,
            allUpdateFieldPremissions: {},
        };
        this.addEmptyBlockButtonId = null;
        this.hashCheck = {
            settings_hash: false,
        };
    }

    checkPermissions (action) {
        if (!this.premissions.hasOwnProperty(action)) {
            this.premissions = Object.assign(this.premissions, {
                [action]: User.checkPermissions(action + '_' + this.config.backendPremissionModelName)
            });
        }
        return this.premissions[action];
    }

    checkPermissionsField (action, index) {
        if (this.edit.state === true &&
            (!index || this.edit.modelId === index) &&
            this.checkPermissions('update_' + action) === true) {
            return true;
        }
        return false;
    }

    getUpdateFieldPremissions () {
        if (this.config.premissions) {
            for (var index in this.config.premissions.update) {
                this.premissions.allUpdateFieldPremissions[this.config.premissions.update[index]] = this.checkPermissions('update_' + this.config.premissions.update[index]);
            }
        }
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
                this.createModels({0: this.edit.new})
                .then((response) => {
                    this.edit = {
                        'modelId': null,
                        'state': false,
                    };
                    if (!this.config.doNotMergeAfterOneSave.includes(this.constructor.name) || (
                        this.config.hasOwnProperty('pagination') &&
                        this.models[this.config.pagination.params.limit - 1] == undefined)) {
                        this.models = Object.assign(this.models, {[response.data[0].id]: response.data[0]});
                    }
                    toastr.success(toastrMessages.success.save);
                }, function (error) {
                    mApp.unblockPage();
                    if (error.responseJSON.message) {
                        toastr.error(error.responseJSON.message);
                    } else {
                        toastr.error(toastrMessages.error.save);
                    }
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
                        toastr.success(toastrMessages.success.update);
                    }, function (error) {
                        mApp.unblockPage();
                        if (error.responseJSON.message) {
                            toastr.error(error.responseJSON.message);
                        } else {
                            toastr.error(toastrMessages.error.update);
                        }
                    }).then(() => {
                        this.rerender();
                    });
                } else {
                    toastr.warning(toastrMessages.warning.nothingToSave);
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
                        this.models = Object.assign(this.models, {[response.data[0].id]: response.data[0]});
                        toastr.success(toastrMessages.success.save);
                    }, function (error) {
                        mApp.unblockPage();
                        if (error.responseJSON.message) {
                            toastr.error(error.responseJSON.message);
                        } else {
                            toastr.error(toastrMessages.error.save);
                        }
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
                    toastr.success(toastrMessages.success.update);
                }, function (error) {
                    mApp.unblockPage();
                    if (error.responseJSON.message) {
                        toastr.error(error.responseJSON.message);
                    } else {
                        toastr.error(toastrMessages.error.update);
                    }
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
            toastr.warning(toastrMessages.warning.nothingToSave);
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
                    toastr.success(toastrMessages.success.delete);
                }, function (error) {
                    mApp.unblockPage();
                    if (error.responseJSON.message) {
                        toastr.error(error.responseJSON.message);
                    } else {
                        toastr.error(toastrMessages.error.delete);
                    }
                });
            } else {
                $('#' + modelId).remove();
                delete this.edit[modelId];
                delete this.validation[modelId];
            }
            $('#' + this.addEmptyBlockButtonId).show();
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
                this.enterEditingSetState(modelId);
            };
            this.utilityBlocksInfo['confirmation-edit-next-model'].open();
        } else {
            this.enterEditingSetState(modelId);
        }
    }

    enterEditingSetState (modelId) {
        this.edit = {
            'modelId': modelId,
            'state': true,
        }
        this.edit[modelId] = Object.assign({}, this.edit[modelId], this.getReleatedAdditions(modelId));
        this.rerender();
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
        if (!jQuery.isEmptyObject(this.pagination)) {
            if (response.length != this.pagination.params.limit) {
                this.pagination.hasMore = false;
            } else {
                this.pagination.hasMore = true;
            }
        }
        this.models = response;
    }

    getReleatedAdditions (modelId) {
        var result = {};
        for (var index in this.config.setReleatedAdditions) {
            var type = this.config.setReleatedAdditions[index],
                typeArray = [];
            for (var modelTypeIndex in this.models[modelId][type]) {
                for (var additionsTypeIndex in this.additions[type]) {
                    if (this.models[modelId][type][modelTypeIndex].id === this.additions[type][additionsTypeIndex].id) {
                        typeArray[additionsTypeIndex] = this.additions[type][additionsTypeIndex];
                        break;
                    }
                }
            }
            result[type] = Object.assign({}, typeArray);
        }
        return result;
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
                    block = new InfoModal(this.constructor.name, 'show-help-model', this.additions.help && this.additions.help[0].message ? this.additions.help[0].message.replace(/^.+$/gm, '<p>$&</p>') : '');
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
            this.pagination.params.offset = offset;
            this.pagination.params.limit = limit;
            return Object.assign({}, {
                'offset': offset,
                'limit': limit,
            }, this.searchOptions);
        } else {
            this.pagination.params.offset = 0;
            return Object.assign({}, this.pagination.params, this.searchOptions)
        }
    }

    paginationMove (offset, limit) {
        simpleAjaxPromise(apiMethods.get, this.config.api.base, this.getMergedSearchOptions(offset, limit))
        .then((response) => {
            this.setData(response.data);
            this.rerender();
        }, (error) => {
            toastr.error(toastrMessages.error.noData);
        });
    }

    searchModels (query) {
        if (query) {
            this.pagination.params.offset = 0;
            this.searchOptions = {
                'q': query,
            };
        } else {
            delete this.searchOptions.q;
        }

        simpleAjaxPromise(apiMethods.get, this.config.api.base, this.getMergedSearchOptions())
        .then((response) => {
            this.setData(response.data);
            this.rerender();
        }, (error) => {
            toastr.error(toastrMessages.error.noData);
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
                if (this.config.validationCheckById) {
                    this.switchValidation(modelId, model, validationIndex, fieldName, true);
                } else {
                    this.switchValidation(modelId, model, validationIndex, fieldName, false);
                }
            }
        }
    }

    switchValidation (modelId, model, validationIndex, fieldName, checkById) {
        var fieldNameFull = '';
        if (checkById) {
            fieldNameFull = modelId + fieldName;
        } else {
            fieldNameFull = fieldName;
        }
        switch (validationIndex) {
            case 'notNull':
                if (this.config.validation.notNull.fieldNames.includes(fieldNameFull) && (model[fieldName] !== 0 && !model[fieldName])) {
                    this.validationAssigne(modelId, fieldName, this.config.validation.notNull.errorMsg);
                } else {
                    this.validationRemove(modelId, fieldName, this.config.validation.notNull.errorMsg);
                }
                break;
            case 'regexSuccess':
                if (this.config.validation.regexSuccess.hasOwnProperty(fieldNameFull)) {
                    var reg = new RegExp(this.config.validation.regexSuccess[fieldNameFull].regex, this.config.validation.regexSuccess[fieldNameFull].flags),
                        match = reg.exec(model[fieldName]);

                    if (!match) {
                        this.validationAssigne(modelId, fieldName, this.config.validation.regexSuccess[fieldNameFull].errorMsg);
                    } else {
                        this.validationRemove(modelId, fieldName, this.config.validation.regexSuccess[fieldNameFull].errorMsg);
                    }
                }
                break;
            case 'regexFailed':
                if (this.config.validation.regexFailed.hasOwnProperty(fieldNameFull)) {
                    var reg = new RegExp(this.config.validation.regexFailed[fieldNameFull].regex, this.config.validation.regexFailed[fieldNameFull].flags),
                        match = reg.exec(model[fieldName]);

                    if (match) {
                        this.validationAssigne(modelId, fieldName, this.config.validation.regexFailed[fieldNameFull].errorMsg);
                    } else {
                        this.validationRemove(modelId, fieldName, this.config.validation.regexFailed[fieldNameFull].errorMsg);
                    }
                }
                break;
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
            errorValidation = this.validation[modelId] ? this.validation[modelId] : {};

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
                        toastr.error(toastrMessages.error.noData);
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
        SettingsDB.getSettings().then(() => {
            $.when.apply(null, this.getAdditions()).done(() => {
                this.getModels().then((response) => {
                    Storage.clear();
                    this.setData(response.data);
                    this.getUpdateFieldPremissions();
                    this.makeTemplate();
                    this.makeUtilityBlocks();
                    this.renderTemplate();
                    this.initListeners();
                    this.initAdditionlClassesJQ();
                }, (error) => {
                    $(tabContentIdJQ).empty();
                    toastr.error(toastrMessages.error.noData);
                })
                .then(function () {
                    mApp.unblockPage();
                });
            });
        });
    }

    rerender () {
        mApp.blockPage();
        $('body').css('padding-right','0px')
        $('.modal-backdrop').remove();
        $.when.apply(null, [SettingsDB.getSettings(true)]).done(() => {
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
        });
    }
}
export default BaseTab