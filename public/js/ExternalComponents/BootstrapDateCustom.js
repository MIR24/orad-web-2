import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class BootstrapDateCustom extends BaseExternalComponent {
    constructor (id, type, value, disabled) {
        super(id, type, disabled);
        this.value = moment(value).format('DD-MM-YYYY');
        this.options = {
            'selectString': '#' + this.id,
            'function': 'datepicker',
            'options': {
                'autoclose': true,
                'format': 'dd-mm-yyyy',
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
                            value="${this.value}"
                        />`;
    }
}
export default BootstrapDateCustom