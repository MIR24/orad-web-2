import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import SpinnerButton from "../Components/SpinnerButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";

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
            var saveBtn = new SaveButton('all');

            saveBtn.init();
            this.addListeners(saveBtn.getListeners());

            // TO DO
            if (isAdmin) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += saveBtn.getTemplate();
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

    valueChange (event) {
        this.updateEditState(event.target.attributes['id'].value, 'value', event.target.value);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction, disabled) {
        var inputId = IdManipulation.getPreparedId('input', index),
            spinnerButton = new SpinnerButton(index, direction),
            controlButtons = '';

        // TO DO
        if (!disabled && isAdmin) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        spinnerButton.init();

        this.addListeners(spinnerButton.getListeners());
        this.setListeners('input', {
            [inputId]: {
                'function': this.valueChange,
                'class': this
            }
        });

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="col-6">
                <div class="row input-group bootstrap-touchspin mb-2">
                    <span class="input-group-addon">${leftValName}</span>
                    ${spinnerButton.getTemplate()}
                    <input ${disabled} type=number id="${inputId}" type="text" class="form-control" value="${inputValue}" >
                    <span class="input-group-addon bootstrap-touchspin-prefix">${rightValName}</span>
                    ${controlButtons}
                </div>
            </div>
        </div>`
    }

    makeEmptyBlock () {
        var firstValId = 'first-val-new',
            secondValId = 'second-val-new',
            valueId = 'value-new',
            emptyCurrencyPlaceholder = 'Валюта',
            spinnerButton = new SpinnerButton('new'),
            controlButtons = '';

        spinnerButton.init();
        this.addListeners(spinnerButton.getListeners());

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
                    <input id="${firstValId}" type="text" class="form-control" placeholder="${emptyCurrencyPlaceholder}" >
                    ${spinnerButton.getTemplate()}
                    <input type=number id="${valueId}" type="text" class="form-control" placeholder="0.0" >
                    <input id="${secondValId}" type="text" class="form-control" placeholder="${emptyCurrencyPlaceholder}" >
                    ${controlButtons}
                </div>
            </div>
        </div>`
    }

    getEmptyBlock (event) {
        return this.makeEmptyBlock();
    }

    saveModel (stringId) {console.log(stringId);
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(this.edit);
        this.rerender();
    }

    removeModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        $('#' + modelId).remove();
        // TO DO
        //this.rerender();
        console.log(modelId);
    }
}
export default CurrencyValues