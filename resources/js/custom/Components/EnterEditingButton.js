import BaseButton from "../BaseClasses/BaseButton.js";

class EnterEditingButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'enter-model-redacting'
        );
    }

    handle (initClass, event) {
        initClass.enterEditing(this.modelId);
    }
}
export default EnterEditingButton