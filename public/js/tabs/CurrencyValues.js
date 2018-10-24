class CurrencyValues extends BaseTab {
    constructor () {
        super();
        this.url = '/test/currency';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate (response) {
        this.models = response;
        this.template = Object.keys(response).map(key => {
            return `<div class="col-12 row justify-content-center">
                ${this.makeBlock(key, response[key].val1, response[key].val2, response[key].value, response[key].dir)}
            </div>`;
        })
        .join('');
    }

    makeBlock (index, leftValName, rightValName, inputValue, direction) {
        var inputId = IdManipulation.getPreparedId('input', index),
            directionId = IdManipulation.getPreparedId('direction-input', index);

        return `<div class="col-6">
            <div class="row input-group bootstrap-touchspin mb-2">
                <span class="input-group-addon">${leftValName}</span>
                <button class="btn btn-secondary" type="button">-</button>
                <input id="${inputId}" type="text" class="form-control" value="${inputValue}">
                <span class="input-group-addon bootstrap-touchspin-prefix">${rightValName}</span>
            </div>
        </div>`
    }
}