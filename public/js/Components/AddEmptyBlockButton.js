import BaseButton from "../BaseClasses/BaseButton.js";

class AddEmptyBlockButton extends BaseButton {
    constructor (id, type) {
        super (
            id,
            type ? type : 'add-empty-block'
        );
    }

    handle (initClass, event) {
        $(event.target).before(initClass.getEmptyBlock())
            .prop('disabled', true);
        initClass.initListeners();
    }
}
export default AddEmptyBlockButton