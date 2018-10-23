class Newsbar extends BaseTab {
    constructor () {
        super();
        this.url = '/test/newsbar';
        this.textareaMaxCharsPerLine = 6;
        this.listeners = {
            'click' : {},
            'input' : {},
        };
        this.names = {
            0: 'Топы',
            1: 'Бегущая строка',
        };
    }

    makeTemplate (response) {
        this.newsbar = response;
        this.template = Object.keys(response).map(key => {
            var text = Object.keys(response[key].releated).map(keyInner => (
                response[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, response[key].title, text);
        })
        .join('');
    }

    makeBlock (index, title, text) {
        var titleId = 'title-' + index,
            textareaId = 'textarea-' + index,
            saveBtnId = 'save-' + index,
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine);

        this.setListeners('input', {
            [titleId]: {
                'function': this.updateTitle,
                'class': this
            },
            [textareaId]: {
                'function': textarea.updateText,
                'class': textarea
            },
        });
        this.setListeners('click', {
            [saveBtnId]: {
                'function': this.saveModel,
                'class': this
            },
        });

        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                <button id="${saveBtnId}" class="btn btn-success">Сохранить</button>
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label for="${textareaId}">${this.names[index]}</label>
                    ${textarea.init()}
                </div>
            </form>
        </div>`
    }

    updateTitle (event) {
        console.log(event.target.value);
    }

    saveModel (event) {
        var modelId = this.getIdFromString(event.target.id);
        console.log(modelId);
    }
}