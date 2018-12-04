import BaseComponent from "../BaseClasses/BaseComponent.js";

class Textarea extends BaseComponent {
    constructor (id, valueName, value, disabled, placeholder) {
        super(id, valueName, 'input', disabled);
        this.placeholder = placeholder ? placeholder : 'Текст';
        this.value = Object.is(value, undefined) ? '' : value;
    }

    makeTemplate () {
        this.template = `<textarea
            ${this.disabledString}
            class="form-control m-input m-input--air"
            id="${this.id}"
            rows="${this.value.split(/\r\n|\r|\n/).length + 1}"
            placeholder="${this.placeholder}"
            >${this.value}</textarea>`;
    }

    handle (initClass, event) {
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default Textarea