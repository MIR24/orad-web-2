import BaseButton from "../BaseClasses/BaseButton.js";

class SaveButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'save-model'
        );
    }

    handle (initClass, event) {
        initClass.saveModel(event.target.id);
    }
}
export default SaveButton