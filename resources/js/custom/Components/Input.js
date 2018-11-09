import BaseComponent from "../BaseClasses/BaseComponent.js";

class Input extends BaseComponent {
    constructor (id, valueName, value, disabled, placeholder, type) {
        super(id, valueName, 'input', disabled);
        this.value = (value === null || value === undefined || !value) ? '' : value;
        this.placeholder = placeholder ? placeholder : '';
        this.type = type ? type : 'text';
    }

    makeTemplate () {
        this.template = `<input
                ${this.disabled} 
                type=${this.type} 
                id="${this.id}"
                class="form-control"
                value="${this.value}" 
                placeholder="${this.placeholder}"
            >`;
    }

    handle (initClass, event) {
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default Input