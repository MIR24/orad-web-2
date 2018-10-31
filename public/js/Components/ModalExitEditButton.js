import BaseButton from "../BaseClasses/BaseButton.js";

class ModalExitEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-exit-edit'
        );
    }

    makeTemplate () {
        this.template = `<button class="btn ${this.config.cssClass}" ${this.config.additions} >${this.config.text}</button>`;
    }

    handle (initClass, event) {console.log(1);
        initClass.cancelEditing();
    }
}
export default ModalExitEditButton