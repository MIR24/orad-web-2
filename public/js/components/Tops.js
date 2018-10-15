var Sections = Sections || {};
Sections.Tops = {
    records: [],
    url: '/mock/tops',
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
                this.records = data.rows;
                this.render();
            },
            error: e => {
                alert(e.message);
                $('.content-loader').hide();
            },
        });
        $('#tops-add').on('click', this.addRecord.bind(this));

        $('#tops-submit').on('click', this.submit.bind(this));
    },

    removeRecord (index) {
        this.records.splice(index, 1);
        this.render();
    },

    submit() {
        console.log(this.records);
    },

    updateField(event, field, index) {
        this.records[index][field] = event.target.value;
        this.render();
    },

    addRecord() {
        this.records.push({
            title: '',
            text: ''
        });
        this.render();
    },

    render() {
        $('.content-loader').show();
        var nodes = this.records.map(function (record, index)  {return `<div class="entity-block">
                    <button type="button" onclick="Sections.Tops.removeRecord(${index})" class="btn btn-danger m-btn m-btn--custom m-btn--bolder m-btn--uppercase delete-block">Удалить</button>
                    <span>${record.id ? 'id: '+record.id : 'Новый'}</span>
                    <div class="form-group m-form__group">
                        <label for="title">Заголовок</label>
                        <input data-index="${index}" onchange="Sections.Tops.updateField(event, 'title', ${index})" type="text" value="${record.title}" class="form-control m-input" id="title" aria-describedby="emailHelp" placeholder="Заголовок">
                    </div>
                    <div class="form-group m-form__group">
                        <label for="text">Текст</label>
                        <textarea data-index="${index}" onchange="Sections.Tops.updateField(event, 'text', ${index})" placeholder="Текст" class="form-control m-input" rows="3">${record.text}</textarea>
                    </div>
                </div>`});
        var result = $.parseHTML(nodes.join(''));
        if (result.length === 0) {
            $('.no-records').show();
        } else {
            $('.no-records').hide();
        }
        $('#tops-container').html(result);
        $('.content-loader').hide();
    }
};
