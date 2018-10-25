import BaseButton from "../BaseClasses/BaseButton.js";

class AddEmptyBlockButton extends BaseButton {
    constructor (id, text, cssClass) {
        super(id, text, cssClass);
        this.handle = this.addEmptyBlock;
    }

    addEmptyBlock (initClass, event) {
        $(event.target).before(initClass.getEmptyBlock());
        initClass.initListeners();
    }
}
export default AddEmptyBlockButton