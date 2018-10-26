import BaseButton from "../BaseClasses/BaseButton.js";

class SaveButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'save-model'
        );
    }

    handle (initClass, event) {
        initClass.saveModel(this.modelId);
    }
}
export default SaveButton