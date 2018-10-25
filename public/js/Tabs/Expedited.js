import BaseTab from "../BaseClasses/BaseTab.js";
import ExpeditedCheckbox from "../Components/ExpeditedCheckbox.js";
import Textarea from "../Components/Textarea.js";
import SpinnerButton from "../Utils/IdManipulation.js";
import IdManipulation from "../Utils/IdManipulation.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";


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
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine),
            checkboxes = new ExpeditedCheckbox(index ,this.models[index].oribts),
            saveBtn = new SaveButton(index),
            rmBtn = new DeleteButton(index);

        textarea.init()
        checkboxes.init();
        saveBtn.init();
        rmBtn.init();

        this.addListeners(checkboxes.getListeners());
        this.addListeners(saveBtn.getListeners());
        this.addListeners(rmBtn.getListeners());
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

        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${saveBtn.getTemplate()}
                ${rmBtn.getTemplate()}
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

    saveModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }

    removeModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }
}
export default Expedited