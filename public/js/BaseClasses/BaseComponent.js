import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class BaseComponent {
    constructor (id, valueName, listener, disabled) {
        this.template = '';
        this.listeners = {
            [listener]: {}
        };
        this.listener = listener;
        this.id = IdManipulation.getPreparedId(valueName, id);
        this.modelId = id;
        this.valueName = valueName;
        this.disabled = disabled;
    }

    makeTemplate () {};

    setListeners() {
        Listeners.set(this, this.listener, {
            [this.id]: {
                'function': this.handle,
                'class': this,
                'addInitClass': true,
            }
        });
    };

    getListeners () {
        return this.listeners;
    }

    getTemplate () {
        return this.template;
    }

    init () {
        this.setListeners();
        this.makeTemplate();
    }
}
export default BaseComponent