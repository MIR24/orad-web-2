import BaseButton from "../BaseClasses/BaseButton.js";

class ModalEnterEditButton extends BaseButton {
    constructor (id, type, modalId) {
        super (
            id,
            type ? type : 'modal-enter-edit'
        );
        this.modalId = modalId;
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}" ${this.config.additions} data-target="#${this.modalId}">${this.config.text}</button>`;
    }

    handle (initClass, event) {
        initClass.enterEditingModal(this.modelId)
    }
}
export default ModalEnterEditButton