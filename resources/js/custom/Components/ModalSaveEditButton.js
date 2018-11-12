import BaseButton from "../BaseClasses/BaseButton.js";

class ModalSaveEditButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'modal-save-edit'
        );
    }
}
export default ModalSaveEditButton