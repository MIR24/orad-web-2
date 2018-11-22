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
            <table class="col-3 table m-table m-table--head-no-border text-center">
                <thead>
                    <tr>
                        <th>Название раздела</th>
                        <th>Максимальное количество символов</th>
                    </tr>
                </thead>
                   <tbody>`;

        this.template += Object.keys(this.models).map(key => {
           return this.makeBlock(key, this.models[key].name, this.models[key].maxChars, disabled);
        })
        .join('')
        .concat('</tbody></table></div>')
        .concat(controlButtons);
    }

    makeBlock(index, name, maxChars, disabled) {
        var maxChars = new Input(index, 'maxChars', maxChars, disabled, '0', 'number');

        maxChars.init();

        this.addListeners(maxChars.getListeners());

        return `<tr id="${index}">
            <td>
                <div class="form-group m-form__group row">
                    <label class="col col-form-label">${name}</label>
                </div>
            </td>
            <td>
                <div class="form-group m-form__group">
                    ${maxChars.getTemplate()}
                </div>
            </td>
        </tr>`;
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default ConfigurationControl