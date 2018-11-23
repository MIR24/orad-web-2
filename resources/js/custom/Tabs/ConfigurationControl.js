import BaseMultiTabChild from "../BaseClasses/BaseMultiTabChild.js";
import Input from "../Components/Input.js";
import SaveButton from "../Components/SaveButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";

class ConfigurationControl extends BaseMultiTabChild {
    constructor (newContanerId) {
        super(newContanerId);
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '<div class="row justify-content-center mb-5">';

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons += enterRedactingBtn.getTemplate();
        }
        controlButtons += '</div>';

        this.template = `<div class="row justify-content-center">
            <table class="col-4 table m-table m-table--head-no-border text-center">
                <thead>
                    <tr>
                        <th class="w-75">Название</th>
                        <th>Значение</th>
                    </tr>
                </thead>
                   <tbody>`;

        this.template += Object.keys(this.models).map(key => {
            if (this.edit.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, this.models[key].desc, tempModel.errorModel.value, disabled, tempModel.errorValidation);
            }
           return this.makeBlock(key, this.models[key].desc, this.models[key].value, disabled, {});
        })
        .join('')
        .concat('</tbody></table></div>')
        .concat(controlButtons);
    }

    makeBlock(index, desc, value, disabled, error) {
        var value = new Input(index, 'value', value, disabled, '0', 'number');

        value.init();

        this.addListeners(value.getListeners());

        return `<tr id="${index}">
            <td>
                <div class="text-left form-group m-form__group row">
                    <label class="col col-form-label">${desc}</label>
                </div>
            </td>
            <td>
                <div class="form-group m-form__group">
                    ${this.getRow(value.getTemplate(), error.value)}
                </div>
            </td>
        </tr>`;
    }

    getRow (elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group has-danger mb-0">
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group">
                ${elementTemplate}
            </div>`;
        }
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default ConfigurationControl