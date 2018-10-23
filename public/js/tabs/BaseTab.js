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
    
    initListeners () {
        for (var type in this.listeners) {
            for (var key in this.listeners[type]) {
                $('#' + key).bind(type, this.listeners[type][key].function.bind(this.listeners[type][key].class));
                delete this.listeners[type][key];
            }
        }
    }

    renderTemplate () {
        tabContentContainer.html(this.template);
    }

    setListeners (type, listenerObj) {
        this.listeners[type] = Object.assign(this.listeners[type], listenerObj);
        console.log(this.listeners.input);
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