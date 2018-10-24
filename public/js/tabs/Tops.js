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
            return this.makeBlock(key, response[key].title, text);
        })
        .join('')
        .concat(this.makeAddEmptyBlockBtn());
    }

    makeBlock (index, title, text) {
        var titleId = 'title-' + index,
            textareaId = 'textarea-' + index,
            saveBtnId = 'save-' + index,
            rmBtnId = 'remove-' + index,
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine);

        textarea.init();

        this.setListeners('input', {
            [titleId]: {
                'function': this.updateTitle,
                'class': this
            },
            [textareaId]: {
                'function': textarea.updateText,
                'class': textarea
            }
        });
        this.setListeners('click', {
            [saveBtnId]: {
                'function': this.saveModel,
                'class': this
            },
            [rmBtnId]: {
                'function': this.removeModel,
                'class': this
            }
        });

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
                    ${textarea.getTemplate()}
                </div>
            </form>
        </div>`
    }
    
    makeAddEmptyBlockBtn () {
        var buttonId = 'tops-add-block';
        this.setListeners('click', {
            [buttonId]: {
                'function': this.addEmptyBlock,
                'class': this
            }
        });
        return `<button id="${buttonId}" class="btn btn-primary">+ Добавить топ</button>`
    }

    addEmptyBlock (event) {
        $(event.target).before(this.makeBlock('new-' + Date.now(), '', ''));
        this.initListeners();
    }

    updateTitle (event) {
        console.log(event.target.value);
    }

    saveModel (event) {
        var modelId = this.getIdFromString(event.target.id);
        console.log(modelId);
    }

    removeModel (event) {
        var modelId = this.getIdFromString(event.target.id);
        console.log(modelId);
    }
}