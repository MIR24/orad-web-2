import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class BaseComponent {
    constructor (parentHandle, id, valueName, listener, disabled) {
        this.template = '';
        this.listeners = {
            [listener]: {}
        };
        this.listener = listener;
        this.id = IdManipulation.getPreparedId(valueName, id);
        this.modelId = id;
        this.valueName = valueName;
        this.disabled = disabled;
        this.parentHandle = parentHandle;
    }

    makeTemplate () {};

    handle (event) {
        this.parentHandle(this.modelId, this.valueName, event.target.value);
    }

    setListeners() {
        Listeners.set(this, this.listener, {
            [this.id]: {
                'function': this.handle,
                'class': this,
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