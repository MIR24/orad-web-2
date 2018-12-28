import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import SimpleButton from "../Components/SimpleButton.js";

class Pagination extends BaseComponentGroup {
    constructor (id, paginationObj) {
        super(id, 'pagination', paginationObj);
        this.pageNumber = this.value.params.offset / this.value.params.limit + 1;
    }

    makeTemplate () {
        var moveForward = new SimpleButton(this.id + '-forward', 'pagination-forward', 'forward', this.value.hasMore),
            moveBack = new SimpleButton(this.id + '-back', 'pagination-back', 'back', this.pageNumber == 1 ? false : true);

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
            initClass.paginationMove(this.value.params.offset + this.value.params.limit, this.value.params.limit)
        } else {
            initClass.paginationMove(this.value.params.offset - this.value.params.limit, this.value.params.limit)
        }
    }
}
export default Pagination