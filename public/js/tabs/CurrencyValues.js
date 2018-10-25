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

    makeTemplate (response) {
        var addEmptyBlock = new AddEmptyBlock(this.constructor.name, null);

        addEmptyBlock.init();

        Listeners.add(this, addEmptyBlock.getListeners());

        this.models = response;
        this.template = Object.keys(response).map(key => {
            return this.makeBlock(key, response[key].val1, response[key].val2, response[key].value, response[key].dir);
        })
        .join('')
        .concat(addEmptyBlock.getTemplate());
    }

    valueChange (event) {
        console.log(event.target.value);
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction) {
        var inputId = IdManipulation.getPreparedId('input', index),
            directionId = IdManipulation.getPreparedId('direction-input', index),
            spinnerButton = new SpinnerButton(index, this.spinnerButtonOptions, direction);

        spinnerButton.init();

        Listeners.add(this, spinnerButton.getListeners());
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

        Listeners.add(this, spinnerButton.getListeners());;

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
}