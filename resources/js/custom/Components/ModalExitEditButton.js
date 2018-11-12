import BaseButton from "../BaseClasses/BaseButton.js";

class ModalExitEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-exit-edit'
        );
    }
}
export default ModalExitEditButton