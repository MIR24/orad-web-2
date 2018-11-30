import BaseMultiTabChild from "../BaseClasses/BaseMultiTabChild.js";
import Input from "../Components/Input.js";
import SaveButton from "../Components/SaveButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import DropZoneCustom from "../ExternalComponents/DropZoneCustom.js";

class WeatherTypes extends BaseMultiTabChild {
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
                        <th>Иконка</th>
                    </tr>
                </thead>
                   <tbody>`;

        this.template += Object.keys(this.models).map(key => {
            if (this.edit.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, this.models[key].type, tempModel.errorModel.icon, disabled, tempModel.errorValidation);
            }
           return this.makeBlock(key, this.models[key].type, this.models[key].icon, disabled, {});
        })
        .join('')
        .concat('</tbody></table></div>')
        .concat(controlButtons);
    }

    makeBlock(index, type, icon, disabled, error) {
        var type = new Input(index, 'type', type, disabled, 'Название'),
            iconDrop = new DropZoneCustom(index, 'icon', false, this.constructor.name, disabled);

        type.init();
        iconDrop.init();

        this.addListeners(type.getListeners());
        this.addAdditionlClassesJQ(index, iconDrop);

        return `<tr id="${index}">
            ${this.getRow(type.getTemplate(), error.type)}
            ${this.getRow(iconDrop.getTemplate(), error.value)}
        </tr>`;
    }

    getRow (elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<td>
                    <div class="form-group m-form__group"><div class="form-group m-form__group has-danger mb-0">
                        ${elementTemplate}
                        <label>${errorMessage}</label>
                    </div>
            </td>`;
        } else {
            return `<td>
                    <div class="form-group m-form__group"><div class="form-group m-form__group">
                        ${elementTemplate}
                    </div>
            </td>`;
        }
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default WeatherTypes