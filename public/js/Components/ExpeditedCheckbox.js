import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class ExpeditedCheckbox {
    constructor (id, checkboxes) {
        this.template = '';
        this.models = checkboxes ? checkboxes : {};
        this.id = id;
        this.listeners = {
            'click': {}
        };
        this.checkAllId = 'check-all-' + id;
    }

    makeTemplate () {
        var checkboxesTemplate = Object.keys(this.models).map(key => {
            return this.makeCheckbox(false, this.models[key].name);
        })
        .join('');

        this.template = `<div class="m-form__group form-group">
            <div class="m-checkbox-list">
                ${checkboxesTemplate}
                <hr>
                <label class="m-checkbox">
                    <input id="${this.checkAllId}" type="checkbox" checked> Выбрать все
                    <span></span>
                </label>
            </div>
        </div>`;
    }
    
    makeCheckbox (disabled, name) {
        var disabled = disabled ? 'disabled': '',
            id = IdManipulation.getPreparedId(name, this.id);
        return `<label class="m-checkbox">
            <input id="${id}" class="toggle" type="checkbox" ${disabled}> ${name}
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
export default ExpeditedCheckbox