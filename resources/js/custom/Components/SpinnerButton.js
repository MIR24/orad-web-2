import BaseButton from "../BaseClasses/BaseButton.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class SpinnerButton extends BaseButton {
    constructor (id, valueName, disabled, firstOption, type) {
        super (
            id,
            type ? type : 'arrow-spinner',
            valueName ? valueName : 'new',
            disabled,
        );
        this.firstOption = firstOption ? this.config.optionsSwitcher[firstOption] : 0;
    }

    makeTemplate () {
        this.template = `<button ${this.disabledString} id=${this.id} class="btn ${this.config.options[this.firstOption].cssClass}" data-option="${this.firstOption}" type="button">${this.config.options[this.firstOption].text}</button>`;
    }

    handle (initClass, event) {
        var select = $(event.target),
            option = parseInt(select.attr('data-option')),
            newOption = option + 1;

        if (!this.config.options.hasOwnProperty(newOption)) {
            newOption = this.config.firstKey;
        }

        event.target.disabled = true;
        initClass.modelChange(this.modelId, this.valueName, this.config.options[newOption].newModelValue);
        select.removeClass(this.config.options[option].cssClass)
            .addClass(this.config.options[newOption].cssClass)
            .attr('data-option', newOption)
            .text(this.config.options[newOption].text);
        event.target.disabled = false;
    }
}
export default SpinnerButton