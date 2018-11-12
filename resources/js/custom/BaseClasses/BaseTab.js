import Listeners from "../Utils/Listeners.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";
import IdManipulation from "../Utils/IdManipulation.js";
import TabsConfig from "../Config/TabsConfig.js";
import { simpleAjaxPromise } from "../Api/Multi.js";
import { apiMethods } from "../Config/Constants.js";

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