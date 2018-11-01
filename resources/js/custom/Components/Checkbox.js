import BaseComponent from "../BaseClasses/BaseComponent.js";

class Checkbox extends BaseComponent {
    constructor (id, valueName, checked, disabled, name) {
        super(id, valueName, 'click', disabled);
        this.checked = checked == true ? 'checked' : '';
        this.name = name ? name : '';
    }

    makeTemplate () {
        this.template = `<label class="m-checkbox">
            <input
                ${this.disabled}
                ${this.checked}
                type="checkbox"
                id="${this.id}"
            /> ${this.name}
            <span></span>
        </label>`;
    }

    handle (initClass, event) {
        initClass.modelChange(this.modelId, this.valueName, event.target.checked);
    }
}
export default Checkbox