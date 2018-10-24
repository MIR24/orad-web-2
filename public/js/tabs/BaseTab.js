class BaseTab {
    constructor () {
        this.csrf = $('meta[name="csrf-token"]').attr('content');
        this.template = '';
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

    getIdFromString (idString) {
        return idString.split('-').pop();
    }

    init () {
        bodyLoader.addClass('m-page--loading');
        this.getModels()
        .then((response) => {
            this.makeTemplate(response);
            this.renderTemplate();
            this.initListeners();
        })
        .then(function () {
            bodyLoader.removeClass('m-page--loading');
        });
    }
}