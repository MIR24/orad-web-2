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

    makeTemplate (response) {
    }

    renderTemplate () {
        tabContentContainer.html(this.template);
    }

    init () {
        bodyLoader.addClass('m-page--loading');
        this.getModels()
        .then((response) => {
            this.makeTemplate(response);
            this.renderTemplate();
        })
        .then(function () {
            bodyLoader.removeClass('m-page--loading');
        });
    }
}