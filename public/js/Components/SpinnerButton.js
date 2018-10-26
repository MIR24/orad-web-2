import BaseButton from "../BaseClasses/BaseButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class SpinnerButton extends BaseButton {
    constructor (id, disabled, firstOption, type) {
        super (
            id,
            type ? type : 'arrow-spinner'
        );
        this.firstOption = firstOption ? firstOption : 0;
        this.disabled = disabled ? disabled : '';
    }

    makeTemplate () {
        this.template = `<button ${this.disabled} id=${this.id} class="btn ${this.config.options[this.firstOption].cssClass}" data-option="${this.firstOption}" type="button">${this.config.options[this.firstOption].text}</button>`;
    }

    handle (initClass, event) {
        var select = $(event.target),
            option = parseInt(select.attr('data-option')),
            newOption = option + 1;

        if (!this.config.options.hasOwnProperty(newOption)) {
            newOption = this.config.firstKey;
        }

        event.target.disabled = true;
        select.removeClass(this.config.options[option].cssClass)
            .addClass(this.config.options[newOption].cssClass)
            .attr('data-option', newOption)
            .text(this.config.options[newOption].text);
        event.target.disabled = false;
    }
}
export default SpinnerButton