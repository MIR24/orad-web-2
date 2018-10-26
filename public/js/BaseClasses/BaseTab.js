import Listeners from "../Utils/Listeners.js";
import IdManipulation from "../Utils/IdManipulation.js";

class BaseTab {
    constructor () {
        this.csrf = $('meta[name="csrf-token"]').attr('content');
        this.template = '';
        this.edit = {
            'modelId': null,
            'state': false,
        };
    }

    getModels () {
        return new Promise ((resolve, reject) => {
            $.ajax({
                headers: {
                    'X-CSRF-Token': this.csrf
                },
                url: this.url,
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

    cancelEditing () {
        this.edit = {
            'modelId': null,
            'state': false,
        }
        this.rerender();
    }

    enterEditing (stringId) {
        this.edit = {
            'modelId': IdManipulation.getIdFromString(stringId),
            'state': true,
        }
        this.rerender();
    }

    setData (response) {
        this.models = response;
    }

    makeTemplate (response) {}
    
    setListeners (type, listenerObj) {
        Listeners.set(this, type, listenerObj);
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    initListeners () {
        Listeners.init(this);
    }

    updateEditState (modelIdString, type, value) {
        var modelId = IdManipulation.getIdFromString(modelIdString);
        if (this.edit.hasOwnProperty(modelId)) {
            this.edit[modelId][type] = value;
        } else {
            this.edit[modelId] = {
                [type]: value
            };
        }
        console.log(this.edit);
    }

    renderTemplate () {
        $('#tab-content').html(this.template);
    }

    init () {
        $('body').addClass('m-page--loading');
        this.getModels()
        .then((response) => {
            this.setData(response);
            this.makeTemplate();
            this.renderTemplate();
            this.initListeners();
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
            resolve();
        }).then(function () {
            $('body').removeClass('m-page--loading');
        });
    }
}
export default BaseTab