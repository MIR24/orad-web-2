import BaseButton from "../BaseClasses/BaseButton.js";

class DeleteButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'remove-model'
        );
    }

    handle (initClass, event) {
        initClass.removeModel(this.modelId);
    }
}
export default DeleteButton