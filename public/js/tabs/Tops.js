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
            textareaId = 'textarea-' + index;
        this.listeners.input[titleId] = this.updateTitle;
        this.listeners.input[textareaId] = this.updateText;
        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
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
        $(this).before(currentTab.makeBlock(Math.random(), '', ''));
        currentTab.addListeners();
    }

    updateText () {
        var select = $(this),
            id = select.attr('id').split('-')[1],
            val = currentTab.checkDisallowedCharacters(select.val()),
            newVal = currentTab.textAreaSplitLines(val, event.inputType);

        if (newVal !== false) {
            val = newVal;
        }

        select.val(val);
    }

    updateTitle () {
        var select = $(this);
        currentTab.tops[select.attr('id').split('-')[1]].title = select.val();
    }
}