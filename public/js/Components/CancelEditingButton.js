import BaseButton from "../BaseClasses/BaseButton.js";

class CancelEditingButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'cancel-model-redacting'
        );
    }

    handle (initClass, event) {
        initClass.cancelEditing();
    }
}
export default CancelEditingButton