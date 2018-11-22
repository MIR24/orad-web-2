import BaseTab from "../BaseClasses/BaseTab.js";

class BaseMultiTabChild extends BaseTab {
    constructor (newContanerId) {
        super();
        this.newContanerId = newContanerId;
    }

    renderTemplate () {
        $('#' + this.newContanerId).html(this.template);
    }
}
export default BaseMultiTabChild