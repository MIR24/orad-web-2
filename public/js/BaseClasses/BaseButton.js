import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";
import ButtonsConfig from "../Config/ButtonsConfig.js";

class BaseButton {
    constructor (id, type) {
        this.template = '';
        this.listeners = {
            'click': {}
        };
        this.id = IdManipulation.getPreparedId(type, id);
        this.type = type;
        this.text = ButtonsConfig[type].text;
        this.cssClass = ButtonsConfig[type].cssClass;
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.cssClass}">${this.text}</button>`;
    }

    setListeners () {
        Listeners.set(this, 'click', {
            [this.id]: {
                'function': this.handle,
                'class': this,
                'addInitClass': true,
            }
        });
    }

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
export default BaseButton