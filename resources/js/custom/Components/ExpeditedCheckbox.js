import BaseComponent from "../BaseClasses/BaseComponent.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class ExpeditedCheckbox extends BaseComponent {
    constructor (id, checkboxes, disabled) {
        super();
        this.models = checkboxes ? checkboxes : {};
        this.id = id;
        this.listeners = {
            'click': {}
        };
        this.checkAllId = 'check-all-' + id;
        this.disabled = disabled;
    }

    makeTemplate () {
        var checkboxesTemplate = Object.keys(this.models).map(key => {
            return this.makeCheckbox(this.models[key].name);
        })
        .join('');

        this.template = `<div class="m-form__group form-group">
            <div class="m-checkbox-list">
                ${checkboxesTemplate}
                <hr>
                <label class="m-checkbox">
                    <input ${this.disabled} id="${this.checkAllId}" type="checkbox" checked> Выбрать все
                    <span></span>
                </label>
            </div>
        </div>`;
    }
    
    makeCheckbox (name) {
        return `<label class="m-checkbox">
            <input id="${IdManipulation.getPreparedId(name, this.id)}" class="toggle" type="checkbox" ${this.disabled}> ${name}
            <span></span>
        </label>`;
    }

    changeState (event) {
        console.log($(event.target).is(':checked'));
    }

    checkAll () {
        console.log('chekc all');
    }

    setListeners () {
        for (var key in this.models) {
            var id = IdManipulation.getPreparedId(this.models[key].name, this.id);
            Listeners.set(this, 'click', {
                [id]: {
                    'function': this.changeState,
                    'class': this
                }
            });
        }
        Listeners.set(this, 'click', {
            [this.checkAllId]: {
                'function': this.checkAll,
                'class': this
            }
        });
    }
}
export default ExpeditedCheckbox