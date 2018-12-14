import BaseButton from "../BaseClasses/BaseButton.js";

class AddEmptyBlockButton extends BaseButton {
    constructor (id, disabled, addToId, type) {
        super (
            id,
            type ? type : 'add-empty-block',
            null,
            disabled,
        );
        this.addToId = addToId;
    }

    handle (initClass, event) {
        if (this.addToId) {
            $('#' + this.addToId).append(initClass.getEmptyBlock());
            $(event.target).hide();
        } else {
            $(event.target).before(initClass.getEmptyBlock())
            .hide();
        }
        initClass.initListeners();
        initClass.initAdditionlClassesJQ();
    }
}
export default AddEmptyBlockButton