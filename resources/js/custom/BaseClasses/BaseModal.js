import ModalsConfig from "../Config/ModalsConfig.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class BaseModal {
    constructor (id, type, model) {
        this.modelId = id; 
        this.id = IdManipulation.getPreparedId('modal-' + type, id);
        this.type = type;
        this.config = ModalsConfig[type];
        this.model = model;
        this.listeners = {};
        this.openButton = '';
        this.modalBodyId = IdManipulation.getPreparedId(this.id, 'body');
    }

    makeModalBody () {
        this.modalBody = this.getModalBody();
    }

    makeTemplate () {
        this.template = this.getBaseTemplate();
    }

    getBaseTemplate () {}
    
    getOpenButton () {
        return this.openButton;
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    getListeners () {
        return this.listeners;
    }

    getTemplate () {
        return this.template;
    }

    init () {
        this.makeModalBody()
        this.makeTemplate();
    }
}
export default BaseModal