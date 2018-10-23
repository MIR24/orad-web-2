class Tops extends BaseTab {
    constructor () {
        super();
        this.url = '/test/tops';
        this.textareaMaxCharsPerLine = 5;
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate (response) {
        this.tops = response;
        this.template = Object.keys(response).map(key => {
            var text = Object.keys(response[key].releated).map(keyInner => (
                response[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, response[key].title , text);
        })
        .join('')
        .concat(this.makeAddEmptyBlockBtn());
    }

    makeBlock (index, title, text) {
        var titleId = 'title-' + index,
            textareaId = 'textarea-' + index,
            saveBtnId = 'save-' + index,
            rmBtnId = 'remove-' + index;
        this.listeners.input[titleId] = this.updateTitle;
        this.listeners.input[textareaId] = this.updateText;
        this.listeners.click[saveBtnId] = this.saveModel;
        this.listeners.click[rmBtnId] = this.removeModel;
        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                <button id="${saveBtnId}" class="btn btn-success">Сохранить</button>
                <button id="${rmBtnId}" class="btn btn-danger">Удалить</button>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label for="${titleId}">Заголовок</label>
                    <input value="${title}" type="title" class="form-control m-input m-input--air" id="${titleId}" aria-describedby="emailHelp" placeholder="Заголовок">
                    <label for="${textareaId}">Текст</label>
                    <textarea class="form-control m-input m-input--air" id="${textareaId}" rows="3" placeholder="Текст">${text}</textarea>
                </div>
            </form>
        </div>`
    }
    
    makeAddEmptyBlockBtn () {
        var buttonId = 'tops-add-block';
        this.listeners.click[buttonId] = this.addEmptyBlock;
        return `<button id="${buttonId}" class="btn btn-primary">+ Добавить топ</button>`
    }

    addEmptyBlock () {
        $(this).before(currentTab.makeBlock('new-' + Date.now(), '', ''));
        currentTab.addListeners();
    }

    updateText () {
        var select = $(this),
            id = currentTab.getIdFromString(select.attr('id')),
            val = currentTab.checkDisallowedCharacters(select.val()),
            newVal = currentTab.textAreaSplitLines(val, event.inputType);

        if (newVal !== false) {
            val = newVal;
        }

        select.val(val);
    }

    updateTitle () {
        var select = $(this);
        console.log(select.val());
    }

    saveModel () {
        var modelId = currentTab.getIdFromString($(this).attr('id'));
        console.log(currentTab.tops[modelId]);
    }

    removeModel () {
        var modelId = currentTab.getIdFromString($(this).attr('id'));
        console.log(modelId);
    }
}