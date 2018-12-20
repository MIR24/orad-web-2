import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";
import Select2Config from "../Config/Select2Config.js";

class Select2Custom extends BaseExternalComponent {
    constructor (id, type, selectOptions, defaultVal, disabled, configType) {
        super(id, type, 'change');
        this.options = Object.assign(this.options, {
            'function': 'select2',
            'options': {
                'minimumResultsForSearch': -1,
                'templateResult': this.formatData,
                'templateSelection': this.formatData,
                'disabled': !disabled,
                'width': '100%',
            },
        });
        this.selectOptions = selectOptions;
        this.defaultVal = defaultVal;
        this.config = Select2Config[configType + '-' + type];
    }

    formatData (data) {
        if (!data.id) {
            return data.text;
        }
        return $(
            `<span>
                <img width="20px" src="${$(data.element).attr('data-image')}"/>
                ${data.text}
            </span>`
        );
    }

    makeOptions () {
        var options = '';
        for (var one in this.selectOptions) {
            if (this.selectOptions[one][this.config.id] == this.defaultVal) {
                options = options.concat(`<option data-image="${this.selectOptions[one][this.config.icon]}" value="${this.selectOptions[one][this.config.id]}" selected="selected">${this.selectOptions[one][this.config.text]}</option>`);
            } else {
                options = options.concat(`<option data-image="${this.selectOptions[one][this.config.icon]}" value="${this.selectOptions[one][this.config.id]}">${this.selectOptions[one][this.config.text]}</option>`);
            }
        }
        return options;
    }

    makeTemplate () {
        this.template = `<select id="${this.id}" class="col-xl form-control js-example-basic-single m-select2">
            ${this.makeOptions()}
        </select>`;
    }
}
export default Select2Custom