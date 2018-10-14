<div class="content">
    <div class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body" id="tops-container"></div>
        <div class="no-records">
            Нет записей
        </div>
        <button id="add" class="btn btn-primary">+ Добавить топ</button>
        <button id="submit" class="btn btn-success btn-submit">Сохранить</button>
    </div>
</div>

<script>
        var records = [],
            csrf = $('meta[name="csrf-token"]').attr('content');

        $('.content-loader').show();

        $.ajax({
            headers: {
                'X-CSRF-Token': csrf
            },
            url: "/mock/tops",
            method: 'GET',
            success: function (data) {
                records = data.rows;
                render(records);
            },
            error: function (e) {
                alert(e.message);
                $('.content-loader').hide();
            },
        });

        function removeRecord (index) {
            records.splice(index, 1);
            render(records);
        }

        function submit () {
            console.log(records);
        }

        function updateField(event, field, index) {
            records[index][field] = event.target.value;
            render();
        }

        function addRecord () {
            records.push({
                title: '',
                text: ''
            });
            render();
        }

        $('#add').on('click', addRecord);

        $('#submit').on('click', submit);

        function render () {
            $('.content-loader').show();
            var nodes = records.map(function (record, index)  {return `<div class="entity-block">
                <button type="button" onclick="removeRecord(${index})" class="btn btn-danger m-btn m-btn--custom m-btn--bolder m-btn--uppercase delete-block">Удалить</button>
                <span>${record.id ? 'id: '+record.id : 'Новый'}</span>
                <div class="form-group m-form__group">
                    <label for="title">Заголовок</label>
                    <input data-index="${index}" onchange="updateField(event, 'title', ${index})" type="text" value="${record.title}" class="form-control m-input" id="title" aria-describedby="emailHelp" placeholder="Заголовок">
                </div>
                <div class="form-group m-form__group">
                    <label for="text">Текст</label>
                    <textarea data-index="${index}" onchange="updateField(event, 'text', ${index})" placeholder="Текст" class="form-control m-input" rows="3">${record.text}</textarea>
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
</script>
