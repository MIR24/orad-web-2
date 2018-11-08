import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import BootstrapDateCustom from "../ExternalComponents/BootstrapDateCustom.js";
import BootstrapTimeCustom from "../ExternalComponents/BootstrapTimeCustom.js";

class DateTime extends BaseComponentGroup {
    constructor (id, valueName, value, disabled) {
        super(id, valueName, value, disabled);
    }

    makeTemplate () {
        var date = new BootstrapDateCustom(this.id, 'date', this.value, this.disabled),
            time = new BootstrapTimeCustom(this.id, 'time', this.value, this.disabled);

        date.init();
        time.init();

        date.setNewHandle(this);
        time.setNewHandle(this);

        this.addAdditionlClassesJQ(this.modelId, date);
        this.addAdditionlClassesJQ(this.modelId, time);

        this.template = `${date.getTemplate()}${time.getTemplate()}`;
    }

    handle (initClass, props, event) {
        var currentValue = moment(this.value, 'YYYY-MM-DD hh:mm:ss');

        if (props.childClass.valueName === 'date') {
            this.value = moment(props.childClass.getNewValue(), 'DD-MM-YYYY').format('YYYY-MM-DD') + ' ' + currentValue.format('hh:mm:ss');
        } else {
            this.value = currentValue.format('YYYY-MM-DD') + ' ' + props.childClass.getNewValue();
        }

        initClass.modelChange(this.modelId, this.valueName, this.value);
    }
}
export default DateTime