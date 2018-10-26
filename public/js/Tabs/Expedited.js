import BaseTab from "../BaseClasses/BaseTab.js";
import ExpeditedCheckbox from "../Components/ExpeditedCheckbox.js";
import Textarea from "../Components/Textarea.js";
import SpinnerButton from "../Utils/IdManipulation.js";
import IdManipulation from "../Utils/IdManipulation.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";


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
            disabled = this.edit.modelId == index || index === 'new' ? '' : 'disabled',
            textarea = new Textarea(index, text, this.textareaMaxCharsPerLine, disabled),
            checkboxes = new ExpeditedCheckbox(index ,this.models[index].oribts),
            controlButtons = '';

        textarea.init()
        checkboxes.init();

        this.addListeners(textarea.getListeners());
        this.addListeners(checkboxes.getListeners());

        if (!disabled) {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelEditingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());
            this.setListeners('input', {
                [titleId]: {
                    'function': this.updateTitle,
                    'class': this
                },
            });
            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var rmBtn = new DeleteButton(index),
                enterRedactingBtn = new EnterEditingButton(index);

            rmBtn.init();
            enterRedactingBtn.init();

            this.addListeners(rmBtn.getListeners());
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = `${enterRedactingBtn.getTemplate()}${rmBtn.getTemplate()}`;
        }

        return `<div id="${index}" class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${controlButtons}
            </div>
            <div class="row">
                <form class="col-md-10 m-form m-form--fit m-form--label-align-right">
                    <div class="form-group m-form__group">
                        <label">Заголовок</label>
                        <input ${disabled} value="${title}" type="title" class="form-control m-input m-input--air" id="${titleId}" aria-describedby="emailHelp" placeholder="Заголовок">
                        <label">Текст</label>
                        ${textarea.getTemplate()}
                    </div>
                </form>
                <form class="col-md-2 pt-4 p-0 m-form m-form--fit m-form--label-align-right">
                    ${checkboxes.getTemplate()}
                </form>
            </div>
        </div>`
    }

    updateText (stringId, newVal) {
        this.updateEditState(stringId, 'text', newVal);
    }

    updateTitle (event) {
        this.updateEditState(event.target.attributes['id'].value, 'title', event.target.value);
    }

    saveModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(this.edit[modelId]);
        this.edit = {
            'modelId': null,
            'state': false,
        }
        this.rerender();
    }

    removeModel (stringId) {console.log(stringId);
        var modelId = IdManipulation.getIdFromString(stringId);
        $('#' + modelId).remove();
        // TO DO
        //this.rerender();
        console.log(modelId);
    }
}
export default Expedited