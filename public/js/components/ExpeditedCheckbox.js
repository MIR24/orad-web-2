class ExpeditedCheckbox {
    constructor (id, checkboxes) {
        this.template = '';
        this.model = checkboxes ? checkboxes : {};
        this.id = id;
        this.listeners = {
            'click': {}
        };
        this.checkAllId = 'check-all-' + id;
    }

    makeTemplate () {
        var checkboxesTemplate = Object.keys(this.model).map(key => {
            return this.makeCheckbox(false, this.model[key].name);
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
            id = this.getPreparedId(name);
        return `<label class="m-checkbox">
            <input id="${id}" class="toggle" type="checkbox" ${disabled}> ${name}
            <span></span>
        </label>`;
    }

    getPreparedId (name) {
        return name + '-' + this.id;
    }

    changeState (event) {
        console.log($(event.target).is(':checked'));
    }

    checkAll () {
        console.log('chekc all');
    }

    setListeners () {
        for (var key in this.model) {
            var id = this.getPreparedId(this.model[key].name);
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