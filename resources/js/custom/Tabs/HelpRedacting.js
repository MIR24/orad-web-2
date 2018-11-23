import BaseMultiTabChild from "../BaseClasses/BaseMultiTabChild.js";

class HelpRedacting extends BaseMultiTabChild {
    constructor (newContanerId) {
        super(newContanerId);
    }

    makeTemplate () {
        this.template = 'test'
    }
}
export default HelpRedacting