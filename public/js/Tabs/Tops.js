import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import Textarea from "../Components/Textarea.js";
import IdManipulation from "../Utils/IdManipulation.js";
import EnterRedactingButton from "../Components/EnterRedactingButton.js";
import CancelRedactingButton from "../Components/CancelRedactingButton.js";

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
        var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);

        addEmptyBlockButton.init();

        this.addListeners(addEmptyBlockButton.getListeners());

        this.template = Object.keys(this.models).map(key => {
            var text = Object.keys(this.models[key].releated).map(keyInner => (
                this.models[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, this.models[key].title, text);
        })
        .join('')
        .concat(addEmptyBlockButton.getTemplate());
    }

    makeBlock (index, title, text) {
        var titleId = IdManipulation.getPreparedId('title', index),
            textareaId = IdManipulation.getPreparedId('textarea', index),
            disabled = this.redacting.modelId == index ? '' : 'disabled',
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine, disabled),
            controlButtons = '';

        if (disabled) {
            var rmBtn = new DeleteButton(index),
                enterRedactingBtn = new EnterRedactingButton(index);

            rmBtn.init();
            enterRedactingBtn.init();

            this.addListeners(rmBtn.getListeners());
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = `${enterRedactingBtn.getTemplate()}${rmBtn.getTemplate()}`;
        } else {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelRedactingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());
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
            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        }

        textarea.init();

        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${controlButtons}
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label for="${titleId}">Заголовок</label>
                    <input ${disabled} value="${title}" type="title" class="form-control m-input m-input--air" id="${titleId}" aria-describedby="emailHelp" placeholder="Заголовок">
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

    saveModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }

    removeModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }

    cancelRedacting (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }

    enterRedacting (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }
}
export default Tops