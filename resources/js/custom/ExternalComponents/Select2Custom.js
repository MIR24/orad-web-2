import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class Select2Custom extends BaseExternalComponent {
    constructor (id, type, selectOptions, defaultVal, disabled) {
        super(id, type);
        this.options = Object.assign(this.options, {
            'function': 'select2',
            'options': {
                'minimumResultsForSearch': -1,
                'templateResult': this.formatData,
                'templateSelection': this.formatData,
                'disabled': disabled
            },
        });
        this.selectOptions = selectOptions;
        this.defaultVal = defaultVal;
    }

    getValue () {
        return this.selectOptions[$(this.options.selectString).val()];
    }

    formatData (data) {
        if (!data.id) {
            return data.text;
        }
        return $(
            `<span>
                <img width="15px" src="${$(data.element).attr('data-image')}"/>
                ${data.text}
            </span>`
        );
    }

    makeOptions () {
        var options = '';
        for (var one in this.selectOptions) {
            if (this.selectOptions[one].id == this.defaultVal) {
                options = options.concat(`<option data-image="${this.selectOptions[one].loc}" value="${this.selectOptions[one].id}" selected="selected">${this.selectOptions[one].text}</option>`);
            } else {
                options = options.concat(`<option data-image="${this.selectOptions[one].loc}" value="${this.selectOptions[one].id}">${this.selectOptions[one].text}</option>`);
            }
        }
        return options;
    }

    makeTemplate () {
        this.template = `<select id="${this.id}" class="form-control js-example-basic-single">
            ${this.makeOptions()}
        </select>`;
    }
}
export default Select2Custom