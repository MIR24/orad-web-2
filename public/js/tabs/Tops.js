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

    makeTemplate () {
        var addEmptyBlock = new AddEmptyBlock(this.constructor.name, '+ Добавить топ');

        addEmptyBlock.init();

        Listeners.add(this, addEmptyBlock.getListeners());

        this.template = Object.keys(this.models).map(key => {
            var text = Object.keys(this.models[key].releated).map(keyInner => (
                this.models[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, this.models[key].title, text);
        })
        .join('')
        .concat(addEmptyBlock.getTemplate());
    }

    makeBlock (index, title, text) {
        var titleId = IdManipulation.getPreparedId('title', index),
            textareaId = IdManipulation.getPreparedId('textarea', index),
            saveBtnId = IdManipulation.getPreparedId('save', index),
            rmBtnId = IdManipulation.getPreparedId('remove', index),
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
    
    getEmptyBlock () {
        return this.makeBlock('new-' + Date.now(), '', '');
    }

    updateTitle (event) {
        console.log(event.target.value);
    }

    saveModel (event) {
        var modelId = IdManipulation.getIdFromString(event.target.id);
        console.log(modelId);
    }

    removeModel (event) {
        var modelId = IdManipulation.getIdFromString(event.target.id);
        console.log(modelId);
    }
}