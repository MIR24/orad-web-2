import Listeners from "../Utils/Listeners.js";

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