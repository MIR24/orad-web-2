import BaseButton from "../BaseClasses/BaseButton.js";

class ModalSaveEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-save-edit'
        );
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}" ${this.config.additions} >${this.config.text}</button>`;
    }

    handle (initClass, event) {
        initClass.cancelEditing();
    }
}
export default ModalSaveEditButton