import BaseComponent from "../BaseClasses/BaseComponent.js";
import IdManipulation from "../Utils/IdManipulation.js";

class BaseExternalComponent extends BaseComponent {
    constructor (id, type, listener, disabled) {
        super (
            id,
            type,
            listener
        );
        this.disabledString = disabled ? 'disabled' : '';
        this.options = {
            'selectString': '#' + this.id,
            'type': type,
        }
    }

    handle (initClass, event) {
        initClass.modelChange(this.modelId, this.valueName, $(this.options.selectString).val());
    }

    getOptions () {
        return this.options;
    }
}
export default BaseExternalComponent