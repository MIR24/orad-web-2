import Listeners from "../Utils/Listeners.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";
import IdManipulation from "../Utils/IdManipulation.js";

class BaseComponentGroup {
    constructor (id, valueName, value, disabled) {
        this.template = '';
        this.listeners = {};
        this.additionlClassesJQ = {};
        this.id = IdManipulation.getPreparedId('group-' + valueName, id);
        this.modelId = id;
        this.valueName = valueName;
        this.value = Object.is(value, undefined) ? '' : value;
        if (disabled) {
            this.disabled = true;
            this.disabledString = ''
        } else {
            this.disabled = false;
            this.disabledString = 'disabled'
        }
    }

    makeTemplate () {};

    addAdditionlClassesJQ (modelId, classVar) {
        AdditionlClassesJQ.add(this.additionlClassesJQ, modelId ,classVar);
        this.addListeners(classVar.getListeners());
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    getAdditionlClassesJQ () {
        return this.additionlClassesJQ;
    }

    getListeners () {
        return this.listeners;
    }
    
    getTemplate () {
        return this.template;
    }

    init () {
        this.makeTemplate();
    }
}
export default BaseComponentGroup