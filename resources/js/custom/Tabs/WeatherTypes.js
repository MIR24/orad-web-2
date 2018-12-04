import BaseMultiTabChild from "../BaseClasses/BaseMultiTabChild.js";
import Input from "../Components/Input.js";
import SaveButton from "../Components/SaveButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import DropZoneCustom from "../ExternalComponents/DropZoneCustom.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import DeleteButton from "../Components/DeleteButton.js";

class WeatherTypes extends BaseMultiTabChild {
    constructor (newContanerId) {
        super(newContanerId);
    }

    makeTemplate () {
        var controlButtons = '<div class="row justify-content-center mb-5">',
            tableBodyId = 'table-body-' + this.constructor.name;

        if (this.edit.state) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all'),
                addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, tableBodyId);

            saveBtn.init();
            cancelEditBtn.init();
            addEmptyBlockButton.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());
            this.addListeners(addEmptyBlockButton.getListeners());

            controlButtons += `${addEmptyBlockButton.getTemplate()}${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else if (this.checkPermissions('update') || this.checkPermissions('create')) {
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
                        ${ !this.edit.state && this.checkPermissions('delete') ? '<th></th>' : '' }
                    </tr>
                </thead>
                   <tbody id="${tableBodyId}">`;

        this.template += Object.keys(this.models).map(key => {
            if (this.edit.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, this.models[key].type, tempModel.errorModel.icon, tempModel.errorValidation);
            }
           return this.makeBlock(key, this.models[key].type, this.models[key].icon, {});
        })
        .join('')
        .concat('</tbody></table></div>')
        .concat(controlButtons);
    }

    makeBlock(index, type, icon, error) {
        var type = new Input(index, 'type', type, this.checkPermissionsField('type'), 'Название'),
            iconDrop = new DropZoneCustom(index, 'icon', false, this.constructor.name, this.checkPermissionsField('icon')),
            controlButtons = '';

        type.init();
        iconDrop.init();

        this.addListeners(type.getListeners());
        this.addAdditionlClassesJQ(index, iconDrop);

        if (!this.edit.state && this.checkPermissions('delete')) {
            var rmBtn = new DeleteButton(index);
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            ${this.getRow(type.getTemplate(), error.type)}
            ${this.getRow(iconDrop.getTemplate(), error.value)}
            ${controlButtons}
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

    getEmptyBlock (event) {
        return this.makeBlock('new', '', '', {});
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default WeatherTypes