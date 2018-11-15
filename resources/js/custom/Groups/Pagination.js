import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import SimpleButton from "../Components/SimpleButton.js";

class Pagination extends BaseComponentGroup {
    constructor (id, paginationObj) {
        super(id, 'pagination', paginationObj);
        this.pageNumber = this.value.take / this.value.skip + 1;
    }

    makeTemplate () {console.log(this);
        var moveForward = new SimpleButton(this.id + '-forward', 'pagination-forward', 'forward', this.value.hasMore ? '' : 'disabled'),
            moveBack = new SimpleButton(this.id + '-back', 'pagination-back', 'back', this.pageNumber == 1 ? 'disabled' : '');

        moveForward.init();
        moveBack.init();

        moveForward.setNewHandle(this, this.__proto__.moveHandle);
        moveBack.setNewHandle(this, this.__proto__.moveHandle);

        this.addListeners(moveForward.getListeners());
        this.addListeners(moveBack.getListeners());

        this.template = `<div class="text-center">
            ${moveBack.getTemplate()}
            <lable class="p-3">${this.pageNumber}</lable>
            ${moveForward.getTemplate()}
        </div>`;
    }

    moveHandle (initClass, props, event) {
        if (props.childClass.valueName === 'forward') {
            initClass.paginationMove(this.value.skip, this.value.take + this.value.skip)
        } else {
            initClass.paginationMove(this.value.skip, this.value.take - this.value.skip)
        }
    }
}
export default Pagination