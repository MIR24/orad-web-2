import Listeners from "../Utils/Listeners.js";
import IdManipulation from "../Utils/IdManipulation.js";
import TabsConfig from "../Config/TabsConfig.js";
import { csrf } from "../Config/Constants.js";

class BaseTab {
    constructor () {
        this.config = TabsConfig[this.constructor.name];
        this.csrf = csrf;
        this.template = '';
        this.listeners = {};
        this.edit = {
            'modelId': null,
            'state': false,
        };
        this.additionlClassesJQ = {};
    }

    getModels () {
        return new Promise ((resolve, reject) => {
            $.ajax({
                headers: {
                    'X-CSRF-Token': this.csrf
                },
                url: this.config.api.get,
                method: 'GET',
                success: data => {
                    resolve(data);
                },
                error: e => {
                    alert(e.message);
                    bodyLoader.removeClass('m-page--loading');
                },
            });
        });
    }

    updateModels () {
        return new Promise ((resolve, reject) => {
            $.ajax({
                headers: {
                    'X-CSRF-Token': this.csrf
                },
                url: this.config.api.update,
                method: 'PUT',
                data: {
                    data: this.getMergedEditStateModels(),
                },
                success: data => {
                    resolve(data);
                },
                error: e => {
                    alert(e.message);
                    bodyLoader.removeClass('m-page--loading');
                },
            });
        });
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

    renderTemplate () {
        $('#tab-content').html(this.template);
    }

    init () {
        $('body').addClass('m-page--loading');
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
    }

    rerender () {
        $('body').addClass('m-page--loading');
        new Promise((resolve) => {
            this.makeTemplate(this.models);
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