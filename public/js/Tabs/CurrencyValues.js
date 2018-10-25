import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import SpinnerButton from "../Components/SpinnerButton.js";
import IdManipulation from "../Utils/IdManipulation.js";

class CurrencyValues extends BaseTab {
    constructor () {
        super();
        this.url = '/test/currency';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
        this.spinnerButtonOptions = {
            'firstKey': 1,
            0: {
                'text': '-',
                'cssClass': 'btn-dark',
            },
            1: {
                'text': '↗',
                'cssClass': 'btn-success',
            },
            2: {
                'text': '↘',
                'cssClass': 'btn-danger',
            },
            3: {
                'text': '→',
                'cssClass': 'btn-secondary',
            }
        };
    }

    makeTemplate () {
        var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name),
            saveBtn = new SaveButton(this.constructor.name);

        addEmptyBlockButton.init();
        saveBtn.init();

        this.addListeners(addEmptyBlockButton.getListeners());
        this.addListeners(saveBtn.getListeners());

        this.template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].val1, this.models[key].val2, this.models[key].value, this.models[key].dir);
        })
        .join('')
        .concat(addEmptyBlockButton.getTemplate())
        .concat(saveBtn.getTemplate());
    }

    valueChange (event) {
        console.log(event.target.value);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction) {
        var inputId = IdManipulation.getPreparedId('input', index),
            directionId = IdManipulation.getPreparedId('direction-input', index),
            spinnerButton = new SpinnerButton(index, this.spinnerButtonOptions, direction),
            saveBtn = new SaveButton(index);

        spinnerButton.init();

        this.addListeners(spinnerButton.getListeners());
        this.setListeners('input', {
            [inputId]: {
                'function': this.valueChange,
                'class': this
            }
        });

        return `<div class="col-12 row justify-content-center">
            <div class="col-6">
                <div class="row input-group bootstrap-touchspin mb-2">
                    <span class="input-group-addon">${leftValName}</span>
                    ${spinnerButton.getTemplate()}
                    <input type=number id="${inputId}" type="text" class="form-control" value="${inputValue}" >
                    <span class="input-group-addon bootstrap-touchspin-prefix">${rightValName}</span>
                </div>
            </div>
        </div>`
    }

    makeEmptyBlock () {
        var firstValId = 'first-val-new',
            secondValId = 'second-val-new',
            valueId = 'value-new',
            emptyCurrencyPlaceholder = 'Валюта',
            spinnerButton = new SpinnerButton('new', this.spinnerButtonOptions, 0);

        spinnerButton.init();

        this.addListeners(spinnerButton.getListeners());;

        return `<div class="col-12 row justify-content-center">
            <div class="col-6">
                <div class="row input-group bootstrap-touchspin mb-3">
                    <input id="${firstValId}" type="text" class="form-control" placeholder="${emptyCurrencyPlaceholder}" >
                    ${spinnerButton.getTemplate()}
                    <input type=number id="${valueId}" type="text" class="form-control" placeholder="0.0" >
                    <input id="${secondValId}" type="text" class="form-control" placeholder="${emptyCurrencyPlaceholder}" >
                </div>
            </div>
        </div>`
    }

    getEmptyBlock (event) {
        return this.makeEmptyBlock();
    }

    saveModel (stringId) {
        console.log(stringId);
    }
}
export default CurrencyValues