import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class Select2Custom extends BaseExternalComponent {
    constructor (id, type, disabled) {
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
    }

    formatData (data) {
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

    makeTemplate () {
        this.template = `<select id="${this.id}" class="form-control js-example-basic-single">
            <option value="WY">Wyoming</option>
            <option value="aa">aa</option>
            <option value="cc">cc</option>
        </select>`;
    }

    getValue () {
        return $(this.options.selectString).val();
    }
}
export default Select2Custom