import BaseExternalComponent from "../BaseClasses/BaseExternalComponent.js";

class BootstrapTimeCustom extends BaseExternalComponent {
    constructor (id, type, value, disabled) {
        super(id, type, 'change', disabled);
        this.value = value ? moment(value).format('HH:mm') : '';
        this.options = {
            'selectString': '#' + this.id,
            'function': 'timepicker',
            'options': {
                'showMeridian': false,
                'minuteStep': 1,
                'defaultTime': false,
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
                            placeholder="Выберите время"
                            value="${this.value}"
                        />`;
    }
}
export default BootstrapTimeCustom