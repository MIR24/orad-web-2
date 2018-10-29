import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class BootstrapDateCustom extends BaseExternalComponent {
    constructor (id, type, value, disabled) {
        super(id, type, disabled);
        this.value = value;
        this.options = {
            'selectString': '#' + this.id,
            'function': 'datepicker',
            'options': {
                'autoclose': true,
                'format': 'dd/mm/yyyy',
            }
        };
    }

    makeTemplate () {
        this.template = `<input
                            id="${this.id}"
                            ${this.disabledString}
                            type="text"
                            class="form-control"
                            readonly 
                            placeholder="Выберите дату"
                        />`;
    }

    getValue () {
        console.log($(this.options.selectString).val());
    }
}
export default BootstrapDateCustom