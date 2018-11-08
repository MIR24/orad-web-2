import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import Checkbox from "../Components/Checkbox.js";

class ExpeditedCheckbox extends BaseComponentGroup {
    constructor (id, valueName, value, disabled) {
        super(id, null, value, disabled);
    }

    makeTemplate () {
        var checkboxAll = new Checkbox(this.id + '-all', 'all', false, this.disabled, 'Выбрать все'),
            checkboxesTemplate = Object.keys(this.value).map(key => {
                var checkbox = new Checkbox(this.id + '-' + key, this.value[key].name, this.value[key].checked, this.disabled, this.value[key].name);

                checkbox.init();
                checkbox.setNewHandle(this);
                this.addListeners(checkbox.getListeners());

                return checkbox.getTemplate();
            })
            .join('');

        checkboxAll.init();
        checkboxAll.setNewHandle(this);
        this.addListeners(checkboxAll.getListeners());

        this.template = `<div class="m-form__group form-group">
            <div class="m-checkbox-list">
                ${checkboxesTemplate}
                <hr>
                ${checkboxAll.getTemplate()}
            </div>
        </div>`;
    }

    handle (initClass, props, event) {
        console.log(initClass, props, event);

        //initClass.modelChange(this.modelId, this.valueName, this.value);
    }
}
export default ExpeditedCheckbox