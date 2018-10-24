class ExpeditedCheckbox {
    constructor (id, checkboxes) {
        this.template = '';
        this.checkboxes = checkboxes ? checkboxes : {};
        this.id = id;
    }

    makeTemplate () {console.log(this);
        var checkboxesTemplate = Object.keys(this.checkboxes).map(key => {
            return this.makeCheckbox(false, this.checkboxes[key].name);
        })
        .join('');

        this.template = `<div class="m-form__group form-group">
            <div class="m-checkbox-list">
                ${checkboxesTemplate}
                <hr>
                <label class="m-checkbox">
                    <input id="test" type="checkbox" checked="checked"> Выбрать все
                    <span></span>
                </label>
            </div>
        </div>`;
    }
    
    makeCheckbox (disabled, name) {
        var disabled = disabled ? 'disabled': '',
            id = name + '-' + this.id;
        return `<label class="m-checkbox">
            <input id="${id}" class="toggle" type="checkbox" ${disabled}> ${name}
            <span></span>
        </label>`;
    }

    init () {
        this.makeTemplate();
        return this.template;
    }
}