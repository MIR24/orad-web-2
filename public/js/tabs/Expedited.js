class Expedited extends BaseTab {
    constructor () {
        super();
        this.url = '/test/expedited';
        this.textareaMaxCharsPerLine = 7;
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate () {
        this.template = Object.keys(this.models).map(key => {
            var text = Object.keys(this.models[key].releated).map(keyInner => (
                this.models[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, this.models[key].title, text);
        })
        .join('');
    }

    makeBlock (index, title, text) {
        var titleId = IdManipulation.getPreparedId('title', index),
            textareaId = IdManipulation.getPreparedId('textarea', index),
            saveBtnId = IdManipulation.getPreparedId('save', index),
            rmBtnId = IdManipulation.getPreparedId('remove', index),
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine),
            checkboxes = new ExpeditedCheckbox(index ,this.models[index].oribts);

        textarea.init()
        checkboxes.init();

        Listeners.add(this, checkboxes.getListeners());
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
            <div class="row">
                <form class="col-md-10 m-form m-form--fit m-form--label-align-right">
                    <div class="form-group m-form__group">
                        <label for="${titleId}">Заголовок</label>
                        <input value="${title}" type="title" class="form-control m-input m-input--air" id="${titleId}" aria-describedby="emailHelp" placeholder="Заголовок">
                        <label for="${textareaId}">Текст</label>
                        ${textarea.getTemplate()}
                    </div>
                </form>
                <form class="col-md-2 pt-4 p-0 m-form m-form--fit m-form--label-align-right">
                    ${checkboxes.getTemplate()}
                </form>
            </div>
        </div>`
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