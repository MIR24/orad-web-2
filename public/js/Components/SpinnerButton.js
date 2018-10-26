import BaseButton from "../BaseClasses/BaseButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class SpinnerButton extends BaseButton {
    constructor (id, firstOption, type) {
        super (
            id,
            type ? type : 'arrow-spinner'
        );
        this.firstOption = firstOption ? firstOption : 0;
    }

    makeTemplate () {
        this.template = `<button id=${this.id} class="btn ${this.options[this.firstOption].cssClass}" data-option="${this.firstOption}" type="button">${this.options[this.firstOption].text}</button>`;
    }

    handle (initClass, event) {
        var select = $(event.target),
            option = parseInt(select.attr('data-option')),
            newOption = option + 1;

        if (!this.options.hasOwnProperty(newOption)) {
            newOption = this.options.firstKey;
        }

        event.target.disabled = true;
        select.removeClass(this.options[option].cssClass)
            .addClass(this.options[newOption].cssClass)
            .attr('data-option', newOption)
            .text(this.options[newOption].text);
        event.target.disabled = false;
    }
}
export default SpinnerButton