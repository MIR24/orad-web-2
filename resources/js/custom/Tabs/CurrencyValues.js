import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import SpinnerButton from "../Components/SpinnerButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";

class CurrencyValues extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '',
            tableBodyId = 'table-body-' + this.constructor.name;

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            if (this.checkPermissions('create')) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, tableBodyId);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else if (this.premisions.isLoggedIn && this.checkPermissions('update')) {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }


        var template = `<table class="table m-table m-table--head-no-border text-center">
            <thead>
                <tr>
                    <th>Валюта</th>
                    <th>Динамика</th>
                    <th>Курс</th>
                    <th>Валюта</th>
                    ${ !disabled && this.checkPermissions('delete') ? '<th></th>' : '' }
                </tr>
            </thead>
            <tbody id="${tableBodyId}">`;
       template += Object.keys(this.models).map(key => {
           if (this.edit.hasOwnProperty(key)) {
               var tempModel = this.getValidatedObject(key);
               return this.makeBlock(key, tempModel.errorModel.val1, tempModel.errorModel.val2, tempModel.errorModel.value, tempModel.errorModel.dir, disabled, tempModel.errorValidation);
           }
           return this.makeBlock(key, this.models[key].val1, this.models[key].val2, this.models[key].value, this.models[key].dir, disabled, {});
       })
       .join('');

       if (this.validation.hasOwnProperty('new')) {
           var tempModel = this.getValidatedObject('new');
           template = template.concat(
               this.makeBlock('new', tempModel.errorModel.val1, tempModel.errorModel.val2, tempModel.errorModel.value, tempModel.errorModel.dir, disabled, tempModel.errorValidation)
           );
       }

       template = template.concat('</tbody></table>')
       .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction, disabled, error) {
        var allowUsage = !disabled ? '' : 'disabled',
            spinnerButton = new SpinnerButton(index, 'dir', disabled, direction),
            leftValNameInput = new Input(index, 'val1', leftValName, allowUsage, 'Валюта'),
            rightValNameInput = new Input(index, 'val2', rightValName, allowUsage, 'Валюта'),
            valueInput = new Input(index, 'value', inputValue, disabled, '0.0', 'number'),
            controlButtons = '';

        spinnerButton.init();
        leftValNameInput.init();
        rightValNameInput.init();
        valueInput.init();

        this.addListeners(spinnerButton.getListeners());
        this.addListeners(leftValNameInput.getListeners());
        this.addListeners(rightValNameInput.getListeners());
        this.addListeners(valueInput.getListeners());

        if (!disabled && this.checkPermissions('delete')) {
            var rmBtn = new DeleteButton(index);
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            <td>${this.getRow(leftValNameInput.getTemplate(), error.val1)}</td>
            <td>${this.getRow(spinnerButton.getTemplate(), error.dir)}</td>
            <td>${this.getRow(valueInput.getTemplate(), error.value)}</td>
            <td>${this.getRow(rightValNameInput.getTemplate(), error.val2)}</td>
            ${controlButtons}
        </tr>`;
    }

    getRow (elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group has-danger mb-0">
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group ">
                ${elementTemplate}
            </div>`;
        }
    }

    getEmptyBlock (event) {
        return this.makeBlock('new', '', '', '', '', '', {});
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default CurrencyValues