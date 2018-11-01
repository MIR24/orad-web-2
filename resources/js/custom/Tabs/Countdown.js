import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";
import BootstrapDateCustom from "../ExternalComponents/BootstrapDateCustom.js";
import BootstrapTimeCustom from "../ExternalComponents/BootstrapTimeCustom.js";

class Countdown extends BaseTab {
    constructor () {
        super();
        this.url = '/test/countdown';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '';

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all'),
                addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);

            saveBtn.init();
            cancelEditBtn.init();
            addEmptyBlockButton.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());
            this.addListeners(addEmptyBlockButton.getListeners());

            controlButtons = `${addEmptyBlockButton.getTemplate()}${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }

        var template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].name, this.models[key].time, disabled);
        })
        .join('')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, eventName, eventDateTime, disabled) {
        var controlButtons = '',
            eventName = new Input(index, 'city', eventName, disabled, 'Название события'),
            eventDate = new BootstrapDateCustom(index, 'date', eventDateTime, disabled),
            eventTime = new BootstrapTimeCustom(index, 'time', eventDateTime, disabled);

        eventName.init();
        eventDate.init();
        eventTime.init();

        this.addListeners(eventName.getListeners());
        this.addAdditionlClassesJQ(eventDate.getOptions());
        this.addAdditionlClassesJQ(eventTime.getOptions());

        if (!disabled) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="row input-group bootstrap-touchspin mb-2">
                ${eventName.getTemplate()}
                ${eventDate.getTemplate()}
                ${eventTime.getTemplate()}
                ${controlButtons}
            </div>
        </div>`;
    }

    getEmptyBlock () {
        return this.makeBlock('new', '');
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        console.log(modelId, this.edit);
        this.edit = {
            'modelId': null,
            'state': false,
        }
        this.rerender();
    }

    removeModel (modelId) {
        $('#' + modelId).remove();
        // TO DO
        //this.rerender();
        console.log(modelId);
    }
}
export default Countdown