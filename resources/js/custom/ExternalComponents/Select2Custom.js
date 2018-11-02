import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class Select2Custom extends BaseExternalComponent {
    constructor (id, type, selectOptions, defaulVal, disabled) {
        super(id, type);
        this.options = {
            'selectString': '#' + this.id,
            'function': 'select2',
            'options': {
                'minimumResultsForSearch': -1,
                'templateResult': this.formatData,
                'templateSelection': this.formatData,
                'disabled': disabled
            }
        };
        this.selectOptions = selectOptions;
        this.defaulVal = defaulVal;
    }

    formatData (data) {console.log(data);
        if (!data.id) {
            return data.text;
        }
        return $(
            `<span>
                <img width="15px" src="https://png.pngtree.com/svg/20170227/test_356816.png"/>
                ${data.text}
            </span>`
        );
    }

    makeOptions () {
        var options = '';console.log(this);
        for (var one in this.selectOptions) {console.log(this.selectOptions, one);
            if (this.selectOptions[one].id == this.defaultVal) {
                options = options.concat(`<option value="${this.selectOptions[one].id}" selected="selected>${this.selectOptions[one].text}</option>`);
            } else {
                options = options.concat(`<option value="${this.selectOptions[one].id}">${this.selectOptions[one].text}</option>`);
            }
        }console.log(options);
        return options;
    }

    makeTemplate () {
        this.template = `<select id="${this.id}" class="form-control js-example-basic-single">
            ${this.makeOptions()}
        </select>`;
    }
}
export default Select2Custom