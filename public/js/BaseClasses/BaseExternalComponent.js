import IdManipulation from "../Utils/IdManipulation.js";

class BaseExternalComponent {
    constructor (id, type) {
        this.template = '';
        this.id = IdManipulation.getPreparedId(type, id);;
        this.type = type;
        this.options = {
            'selectString': null
        }
    }

    makeTemplate () {}
    getValue () {}

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