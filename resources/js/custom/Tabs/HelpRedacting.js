import BaseMultiTabChild from "../BaseClasses/BaseMultiTabChild.js";
import Textarea from "../Components/Textarea.js";
import SaveButton from "../Components/SaveButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";

class HelpRedacting extends BaseMultiTabChild {
    constructor (newContanerId) {
        super(newContanerId);
    }

    makeTemplate () {
        this.template = Object.keys(this.models).map(key => {
            if (this.validation.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, tempModel.errorModel.name, tempModel.errorModel.text, tempModel.errorValidation);
            }
            return this.makeBlock(key, this.models[key].name, this.models[key].text, {});
        })
        .join('');
    }

    makeBlock (index, name, text, error) {
        var text = new Textarea(index, 'text', text, this.checkPermissionsField('text')),
            controlButtons = '',
            headTemplate = '';

        text.init();
        this.addListeners(text.getListeners());

        if (this.edit.modelId == index) {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelEditingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else if (this.checkPermissions('update')) {
            var enterRedactingBtn = new EnterEditingButton(index);
            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());
            controlButtons = enterRedactingBtn.getTemplate();
        }

        return `<div class="mx-3">
            <div id="${index}" class="col p-0 m-portlet bg-secondary m-portlet--skin-dark m-portlet--bordered m-portlet--rounded">
                ${ controlButtons ? `<div class="m-portlet__head p-0">
                    <div class="row col align-items-center">
                        <div class="col-6"></div>
                        <div class="col-6 m--align-right">
                            ${controlButtons}
                        </div>
                    </div>
                </div>`: '' }
                <div class="m-portlet__body">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        ${this.getRow(name, text.getTemplate(), error.text)}
                    </form>
                </div>
            </div>
        </div>`
    }

    getRow (label, elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group row has-danger">
                <label>${label}</label>
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group row">
                <label>${label}</label>
                ${elementTemplate}
            </div>`;
        }
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveOneModel(modelId);
    }
}
export default HelpRedacting