import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import SpinnerButton from "../Components/SpinnerButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";

// TO DO
const isAdmin = true;

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

            // TO DO
            if (isAdmin) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, tableBodyId);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
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
                    ${ !disabled && isAdmin ? '<th></th>' : '' }
                </tr>
            </thead>
            <tbody id="${tableBodyId}">`;
       template += Object.keys(this.models).map(key => {
           return this.makeBlock(key, this.models[key].val1, this.models[key].val2, this.models[key].value, this.models[key].dir, disabled, this.models[key].error);
       })
       .join('')
       .concat('</tbody></table>')
       .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction, disabled, error) {
        var allowUsage = (!disabled && isAdmin) ? '' : 'disabled',
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

        // TO DO
        if (!disabled && isAdmin) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            <td>${this.getRow(leftValNameInput.getTemplate(), error ? error.val1 : false)}</td>
            <td>${this.getRow(spinnerButton.getTemplate(), error ? error.dir : false)}</td>
            <td>${this.getRow(valueInput.getTemplate(), error ? error.value : false)}</td>
            <td>${this.getRow(rightValNameInput.getTemplate(), error ? error.val2 : false)}</td>
            ${controlButtons}
        </tr>`;
    }

    getRow (elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group row has-danger mb-0">
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group row">
                ${elementTemplate}
            </div>`;
        }
    }

    getEmptyBlock (event) {
        return this.makeBlock('new');
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default CurrencyValues