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
        this.url = '/test/currency';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '';

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            // TO DO
            if (isAdmin) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
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

        this.template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].val1, this.models[key].val2, this.models[key].value, this.models[key].dir, disabled);
        })
        .join('')
        .concat(controlButtons);
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction, disabled) {
        var spinnerButton = new SpinnerButton(index, 'direction', disabled, direction),
            valueInput = new Input(index, 'value', inputValue, disabled, '0.0', 'number'),
            controlButtons = '';

        // TO DO
        if (!disabled && isAdmin) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        spinnerButton.init();
        valueInput.init();

        this.addListeners(spinnerButton.getListeners());
        this.addListeners(valueInput.getListeners());

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="col-6">
                <div class="row input-group bootstrap-touchspin mb-2">
                    <span class="input-group-addon">${leftValName}</span>
                    ${spinnerButton.getTemplate()}
                    ${valueInput.getTemplate()}
                    <span class="input-group-addon bootstrap-touchspin-prefix">${rightValName}</span>
                    ${controlButtons}
                </div>
            </div>
        </div>`
    }

    makeEmptyBlock () {
        var spinnerButton = new SpinnerButton('new'),
            leftValNameInput = new Input('new', 'val1', '', false, 'Валюта'),
            rightValNameInput = new Input('new', 'val2', '', false, 'Валюта'),
            valueInput = new Input('new', 'value', '', false, '0.0', 'number'),
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
        if (isAdmin) {
            var rmBtn = new DeleteButton('new', 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="new" class="col-12 row justify-content-center">
            <div class="col-6">
                <div class="row input-group bootstrap-touchspin mb-3">
                    ${leftValNameInput.getTemplate()}
                    ${spinnerButton.getTemplate()}
                    ${valueInput.getTemplate()}
                    ${rightValNameInput.getTemplate()}
                    ${controlButtons}
                </div>
            </div>
        </div>`
    }

    getEmptyBlock (event) {
        return this.makeEmptyBlock();
    }

    saveModel (modelId) {
        console.log(modelId, this.edit);
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
export default CurrencyValues