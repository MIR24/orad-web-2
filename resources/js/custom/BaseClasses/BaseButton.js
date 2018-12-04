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
            disabled === undefined ? true : disabled,
            type,
        );
        this.config = Object.assign({}, ButtonsConfig['base'], ButtonsConfig[type]);
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn ${this.config.cssClass}" ${this.config.additions} ${this.disabledString}>${this.config.text}</button>`;
    }
}
export default BaseButton