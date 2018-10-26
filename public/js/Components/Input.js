import BaseComponent from "../BaseClasses/BaseComponent.js";

class Input extends BaseComponent {
    constructor (parentHandle, id, valueName, value, disabled, placeholder, type) {
        super(parentHandle, id, valueName, 'input', disabled);
        this.value = value;
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
}
export default Input