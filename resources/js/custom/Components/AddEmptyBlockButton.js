import BaseButton from "../BaseClasses/BaseButton.js";

class AddEmptyBlockButton extends BaseButton {
    constructor (id, addToId, type) {
        super (
            id,
            type ? type : 'add-empty-block'
        );
        this.addToId = addToId;
    }

    handle (initClass, event) {
        if (this.addToId) {
            $('#' + this.addToId).append(initClass.getEmptyBlock());
            $(event.target).prop('disabled', true);
        } else {
            $(event.target).before(initClass.getEmptyBlock())
            .prop('disabled', true);
        }
        initClass.initListeners();
        initClass.initAdditionlClassesJQ();
    }
}
export default AddEmptyBlockButton