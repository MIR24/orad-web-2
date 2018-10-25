import IdManipulation from "../utils/IdManipulation.js";
import Listeners from "../utils/Listeners.js";

class BaseButton {
    constructor (id, text, cssClass) {
        this.template = '';
        this.listeners = {
            'click': {}
        };
        this.id = IdManipulation.getPreparedId('add-empty-block', id);
        this.text = text ? text : '+ Добавить';
        this.cssClass = cssClass;
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