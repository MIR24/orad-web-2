import Listeners from "../Utils/Listeners.js";
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

    addAdditionlClassesJQ (modaleId, classVar) {
        var options = classVar.getOptions();
        if (this.additionlClassesJQ.hasOwnProperty(modaleId)) {
            this.additionlClassesJQ[modaleId] = Object.assign(this.additionlClassesJQ[modaleId], {
                [options.selectString]: options
            });
        } else {
            this.additionlClassesJQ[modaleId] = {
                [options.selectString]: options
            };
        }
        this.addListeners(classVar.getListeners());
    }

    initAdditionlClassesJQ () {
        for (var modelId in this.additionlClassesJQ) {
            for (var elementId in this.additionlClassesJQ[modelId]) {
                $(this.additionlClassesJQ[modelId][elementId].selectString)[this.additionlClassesJQ[modelId][elementId].function](this.additionlClassesJQ[modelId][elementId].options);
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