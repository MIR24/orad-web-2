import BaseTab from "../BaseClasses/BaseTab.js";
import Textarea from "../Components/Textarea.js";
import SpinnerButton from "../Utils/IdManipulation.js";
import IdManipulation from "../Utils/IdManipulation.js";
import SaveButton from "../Components/SaveButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";

class Newsbar extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = Object.keys(this.models).map(key => {
            var text = Object.keys(this.models[key].releated).map(keyInner => (
                this.models[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, this.models[key].title, text);
        })
        .join('');
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, title, text) {
        var disabled = this.edit.modelId == index || index === 'new' ? '' : 'disabled',
            textarea = new Textarea(index, text, this.textareaMaxCharsPerLine, disabled),
            controlButtons = '';

        textarea.init();

        this.addListeners(textarea.getListeners());

        if (!disabled) {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelEditingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var enterRedactingBtn = new EnterEditingButton(index);

            enterRedactingBtn.init();

            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = `${enterRedactingBtn.getTemplate()}`;
        }

        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${controlButtons}
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label>${this.config.groupNames[index]}</label>
                    ${textarea.getTemplate()}
                </div>
            </form>
        </div>`
    }

    updateText (stringId, newVal) {
        this.updateEditState(stringId, 'text', newVal);
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        console.log(this.edit[modelId]);
        this.edit = {
            'modelId': null,
            'state': false,
        }
        this.rerender();
    }

    removeModel (modelId) {
        $('#' + modelId).remove();
        // TO DO
        //this.rerender();
        console.log(modelId);
    }
}
export default Newsbar