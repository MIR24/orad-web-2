class BaseTab {
    constructor () {
        this.csrf = $('meta[name="csrf-token"]').attr('content');
        this.template = '';
        this.redacting = {
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

    initListeners () {
        Listeners.init(this);
    }

    renderTemplate () {
        tabContentContainer.html(this.template);
    }

    init () {
        bodyLoader.addClass('m-page--loading');
        this.getModels()
        .then((response) => {
            this.setData(response);
            this.makeTemplate();
            this.renderTemplate();
            this.initListeners();
        })
        .then(function () {
            bodyLoader.removeClass('m-page--loading');
        });
    }

    rerender () {
        bodyLoader.addClass('m-page--loading');
        new Promise((resolve) => {
            this.makeTemplate(this.models);
            this.renderTemplate();
            this.initListeners();
            resolve();
        }).then(function () {
            bodyLoader.removeClass('m-page--loading');
        });
    }
}