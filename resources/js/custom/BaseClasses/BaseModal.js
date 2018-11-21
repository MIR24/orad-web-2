import ModalsConfig from "../Config/ModalsConfig.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class BaseModal {
    constructor (id, type, model) {
        this.modelId = id; 
        this.id = IdManipulation.getPreparedId('modal-' + type, id);
        this.type = type;
        this.config = Object.assign({}, ModalsConfig[type], ModalsConfig['default']);
        this.model = model;
        this.listeners = {};
        this.openButton = '';
        this.modalBodyId = IdManipulation.getPreparedId(this.id, 'body');
        this.modalContentId = IdManipulation.getPreparedId(this.id, 'content');
    }

    getModalBody () {};
    getBaseTemplate () {};

    makeModalBody () {
        this.modalBody = this.getModalBody();
    }

    makeTemplate () {
        this.template = this.getBaseTemplate();
    }
    
    getOpenButton () {
        return this.openButton;
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    getListeners () {
        var tempListeners = this.listeners;
        this.listeners = {};
        return tempListeners;
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