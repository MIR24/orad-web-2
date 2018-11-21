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
            if (this.validation.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, tempModel.errorModel.text, tempModel.errorModel.strings, tempModel.errorValidation);
            }
            return this.makeBlock(key, this.models[key].text, this.models[key].strings, {});
        })
        .join('');
        this.template = this.getBaseContainerFullWidth(template);
    }

    makeBlock (index, title, text, error) {
        var disabled = this.edit.modelId == index || index === 'new' ? '' : 'disabled',
            textarea = new Textarea(index, 'strings', text, this.config.textMaxCharsPerLine, disabled),
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

        return `<div class="col-12 p-0 m-portlet bg-secondary m-portlet--skin-dark m-portlet--bordered m-portlet--rounded">
            <div class="m-portlet__head p-0">
                <div class="row col align-items-center">
                    <div class="col-6"></div>
                    <div class="col-6 m--align-right">
                        ${controlButtons}
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                ${ error && error.strings ? `<form class="m-form m-form--fit m-form--label-align-right  has-danger">
                    <div class="form-group m-form__group">
                        <label>${title}</label>
                        ${textarea.getTemplate()}
                        <label>${error.strings}</label>
                    </div>
                </form>` : `<form class="m-form m-form--fit m-form--label-align-right">
                    <div class="form-group m-form__group">
                        <label>${title}</label>
                        ${textarea.getTemplate()}
                    </div>
                </form>` }
            </div>
        </div>`
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveOneModel(modelId);
    }
}
export default Newsbar