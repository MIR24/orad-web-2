import BaseButton from "../BaseClasses/BaseButton.js";

class ModalEnterEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-enter-edit'
        );
        this.modalId = id;
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}" ${this.config.additions} data-target="#${this.modalId}">${this.config.text}</button>`;
    }

    handle (initClass, event) {
        initClass.enterEditingModel(this.modelId);
    }
}
export default ModalEnterEditButton