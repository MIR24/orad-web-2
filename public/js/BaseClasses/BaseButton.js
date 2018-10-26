import BaseComponent from "../BaseClasses/BaseComponent.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";
import ButtonsConfig from "../Config/ButtonsConfig.js";

class BaseButton extends BaseComponent {
    constructor (id, type, valueName, disabled) {
        super (
            id,
            valueName,
            'click',
            disabled,
            type,
        );
        this.config = ButtonsConfig[type];
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}">${this.config.text}</button>`;
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
}
export default BaseButton