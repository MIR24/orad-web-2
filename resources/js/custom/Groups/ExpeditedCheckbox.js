import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import Checkbox from "../Components/Checkbox.js";

class ExpeditedCheckbox extends BaseComponentGroup {
    constructor (id, valueName, value, disabled) {
        super(id, valueName, value, disabled);
        this.checkboxesIds = [];
    }

    makeTemplate () {
        var checkboxAll = new Checkbox(this.id + '-all', 'all', false, this.disabledString, 'Выбрать все'),
            checkboxesTemplate = Object.keys(this.value).map(key => {
                var checkbox = new Checkbox(this.id + '-' + key, key, this.value[key].checked, this.disabledString, this.value[key].name);

                this.checkboxesIds.push('#' + checkbox.id);

                checkbox.init();
                checkbox.setNewHandle(this, this.checkHandle);
                this.addListeners(checkbox.getListeners());

                return checkbox.getTemplate();
            })
            .join('');

        checkboxAll.init();
        checkboxAll.setNewHandle(this, this.checkHandleAll);
        this.addListeners(checkboxAll.getListeners());

        this.template = `<div class="m-form__group form-group">
            <div class="m-checkbox-list">
                ${checkboxesTemplate}
                <hr>
                ${checkboxAll.getTemplate()}
            </div>
        </div>`;
    }

    checkHandle (initClass, props, event) {
        if (event.target.checked) {
            initClass.addToEditState(this.modelId, this.valueName, {
                [props.childClass.valueName]: this.value[props.childClass.valueName]
            });
        } else {
            initClass.removeFromEditState(this.modelId, this.valueName, props.childClass.valueName);
        }
    }

    checkHandleAll (initClass, props, event) {
        if (event.target.checked) {
            for (var checkboxId in this.checkboxesIds) {
                var select = $(this.checkboxesIds[checkboxId]);
                if (select.is(":checked")) {
                    select.prop('disabled', true);
                } else {
                    select.trigger('click').prop('disabled', true);
                }
            }
        } else {
            $(this.checkboxesIds.join(', ')).prop('disabled', false);
        }
    }
}
export default ExpeditedCheckbox