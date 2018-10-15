var Sections = Sections || {};
Sections.Newsbar = {
    records: {},
    url: '/mock/newsbar',
    csrf: $('meta[name="csrf-token"]').attr('content'),

    init() {
        $('.content-loader').show();
        $.ajax({
            headers: {
                'X-CSRF-Token': this.csrf
            },
            url: this.url,
            method: 'GET',
            success: data => {
                this.records = data;
                this.render();
            },
            error: e => {
                alert(e.message);
                $('.content-loader').hide();
            },
        });
    },

    submit() {
        console.log(this.records);
    },

    updateField(event, field) {
        this.records[field] = event.target.value;
        this.render();
    },

    render() {
        $('.content-loader').show();

        var tops = `<div class="m-form m-form--fit m-form--label-align-right">
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="tops">Топы</label>
                        <textarea value="${this.records.tops}"  placeholder="Топы" class="form-control m-input" id="tops" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="entity-block newsbar">
                    <div class="form-group m-form__group">
                        <label for="ticker">Бегущая строка</label>
                        <textarea value="${this.records.ticker}"  placeholder="Бегущая строка" class="form-control m-input" id="ticker" rows="10">${this.records.ticker}</textarea>
                    </div>
                </div>
            </div>
        </div>`;

        var result = $.parseHTML(tops);
        $('#tops-container').html(result);
        $('.content-loader').hide();
    }
};
