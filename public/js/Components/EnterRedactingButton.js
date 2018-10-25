import BaseButton from "../BaseClasses/BaseButton.js";

class EnterRedactingButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'enter-model-redacting'
        );
    }

    handle (initClass, event) {
        initClass.enterRedacting(event.target.id);
    }
}
export default EnterRedactingButton