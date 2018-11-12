import BaseButton from "../BaseClasses/BaseButton.js";

class ModalEnterEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-enter-edit'
        );
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}" ${this.config.additions} data-target="#${this.modelId}">${this.config.text}</button>`;
    }
}
export default ModalEnterEditButton