import BaseButton from "../BaseClasses/BaseButton.js";

class CancelRedactingButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'cancel-model-redacting'
        );
    }

    handle (initClass, event) {
        initClass.cancelRedacting(event.target.id);
    }
}
export default CancelRedactingButton