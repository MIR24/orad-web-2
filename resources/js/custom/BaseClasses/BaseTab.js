import Listeners from "../Utils/Listeners.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";
import IdManipulation from "../Utils/IdManipulation.js";
import TabsConfig from "../Config/TabsConfig.js";
import { simpleAjaxPromise } from "../Api/Multi.js";
import { apiMethods, toasterMessages } from "../Config/Constants.js";

class BaseTab {
    constructor () {
        this.config = TabsConfig[this.constructor.name];
        this.template = '';
        this.listeners = {};
        this.edit = {
            'modelId': null,
            'state': false,
        };
        this.additionlClassesJQ = {};
        this.additions = {};
    }

    getModels () {
        return simpleAjaxPromise(apiMethods.get, this.config.api.base);
    }

    updateModels (models) {
        return simpleAjaxPromise(apiMethods.update, this.config.api.update, models);
    }

    createModels (models) {
        return simpleAjaxPromise(apiMethods.create, this.config.api.base, models);
    }

    deleteModel (modelId) {
        return simpleAjaxPromise(apiMethods.delete, this.config.api.delete + modelId);
    }

    saveModel (modelId) {}

    saveOneModel (modelId) {
        if (modelId === 'new') {
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
        } else {
            var models = this.getMergedEditStateModels();
            if (models.length > 0) {
                this.updateModels(models)
                .then((response) => {
                    this.edit = {
                        'modelId': null,
                        'state': false,
                    };
                    this.models[modelId] = Object.assign(this.models[modelId], response[0]);
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

    saveAllModels () {
        var arrayOfPromises = [],
            models = this.getMergedEditStateModels();

        if (this.edit.hasOwnProperty('new')) {
            arrayOfPromises.push(
                this.createModels(this.getNewEditStateModel())
                .then((response) => {
                    this.models = Object.assign(this.models, {[response.data.id]: response.data});
                    toastr.success(toasterMessages.success.save);
                }, function (error) {
                    toastr.error(toasterMessages.error.save);
                })
            );
        }

        if (models.length > 0) {
            arrayOfPromises.push(
                this.updateModels(models)
                .then((response) => {
                    for (var responseId in response) {
                        for (var modelId in this.models) {
                            if (response[responseId].id === this.models[modelId].id) {
                                this.models[modelId] = response[responseId];
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

        $.when.apply(null, arrayOfPromises).done(() => {
            this.edit = {
                'modelId': null,
                'state': false,
            };
            this.rerender();
        });
    }

    removeModel (modelId) {
        if (this.models.hasOwnProperty(modelId)) {
            this.deleteModel(this.models[modelId].id)
            .then((response) => {
                if (this.edit.hasOwnProperty(modelId)) {
                    delete this.edit[modelId];
                }
                $('#' + modelId).remove();
                delete this.models[modelId];
                this.rerender();
                toastr.success(toasterMessages.success.delete);
            }, function (error) {
                toastr.error(toasterMessages.error.delete);
            });
        } else {
            $('#' + modelId).remove();
        }
    }

    cancelEditing () {
        this.edit = {
            'modelId': null,
            'state': false,
        }
        this.rerender();
    }

    enterEditing (modelId) {
        this.edit = {
            'modelId': modelId,
            'state': true,
        }
        this.rerender();
    }

    cancelEditingModal () {
        this.edit = {
            'modelId': null,
            'state': false,
        }
    }

    enterEditingModel (modelId) {
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

    getMergedEditStateModels () {
        var results = [];
        for (var modelId in this.edit) {
            if (this.models.hasOwnProperty(modelId)) {
                results.push(Object.assign(this.models[modelId], this.edit[modelId]));
            }
        }
        return results;
    }

    getNewEditStateModel () {
        return Object.assign(this.config.defaultEditState, this.edit.new);
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
            this.edit = {
                'modelId': this.edit.modelId,
                'state': true,
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
        $('#tab-content').html(this.template);
    }

    init () {
        $.when.apply(null, this.getAdditions()).done(() => {
            this.getModels()
            .then((response) => {
                this.setData(response.data);
                this.makeTemplate();
                this.renderTemplate();
                this.initListeners();
                this.initAdditionlClassesJQ();
            }, (error) => {
                toastr.error(toasterMessages.error.noData);
            })
            .then(function () {
                $('body').removeClass('m-page--loading');
            });
        });
    }

    rerender () {
        $('body').addClass('m-page--loading');
        new Promise((resolve) => {
            this.makeTemplate();
            this.renderTemplate();
            this.initListeners();
            this.initAdditionlClassesJQ();
            resolve();
        }).then(function () {
            $('body').removeClass('m-page--loading');
        });
    }
}
export default BaseTab