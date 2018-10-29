import IdManipulation from "../Utils/IdManipulation.js";

class BaseExternalComponent {
    constructor (id, type, disabled) {
        this.template = '';
        this.id = IdManipulation.getPreparedId(type, id);;
        this.type = type;
        this.disabledString = disabled ? 'disabled' : '';
        this.options = {
            'selectString': null
        }
    }

    makeTemplate () {}

    getValue () {
        return $(this.options.selectString).val();
    }

    getOptions () {
        return this.options;
    }

    getTemplate () {
        return this.template;
    }

    init () {
        this.makeTemplate();
    }
}
export default BaseExternalComponent