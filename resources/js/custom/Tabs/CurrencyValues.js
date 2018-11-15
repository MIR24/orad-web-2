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


        var template = `<div class="col-12 row justify-content-center">
            <div class="col-8 row input-group bootstrap-touchspin mb-2">
                <lable class="col">Валюта</lable>
                <lable class="col">Динамика</lable>
                <lable class="col">Курс</lable>
                <lable class="col">Валюта</lable>
                ${ !disabled && isAdmin ? '<lable class="col-2"></lable>' : '' }
            </div>
        </div>`;
        template += Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].val1, this.models[key].val2, this.models[key].value, this.models[key].dir, disabled);
        })
        .join('')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction, disabled) {
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
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="new" class="col-12 row justify-content-center">
            <div class="col-8">
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
        return this.makeBlock('new');
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default CurrencyValues