import BaseButton from "../BaseClasses/BaseButton.js";

class DeleteButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'remove-model'
        );
    }

    handle (initClass, event) {
        initClass.removeModel(event.target.id);
    }
}
export default DeleteButton