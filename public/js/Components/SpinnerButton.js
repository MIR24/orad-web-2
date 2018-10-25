import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class SpinnerButton {
    constructor (id, options, firstOption) {
        this.template = '';
        this.id = IdManipulation.getPreparedId('spinner-btn', id);
        this.options = options;
        this.firstOption = firstOption;
        this.listeners = {
            'click': {}
        }
    }

    makeTemplate (option) {
        this.template = `<button id=${this.id} class="btn ${this.options[option].cssClass}" data-option="${option}" type="button">${this.options[option].text}</button>`;
    }

    clicked (event) {
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

    setListeners () {
        Listeners.set(this, 'click', {
            [this.id]: {
                'function': this.clicked,
                'class': this
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
        this.makeTemplate(this.firstOption);
    }
}
export default SpinnerButton