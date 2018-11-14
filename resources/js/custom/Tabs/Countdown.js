import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";
import DateTime from "../Groups/DateTime.js";

class Countdown extends BaseTab {
    constructor () {
        super();
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

        var template = `<div class="col-12 row justify-content-center">
                <div class="row input-group bootstrap-touchspin mb-2">
                    <lable class="col">Название</lable>
                    <lable class="col">Дата</lable>
                    <lable class="col">Время</lable>
                    ${ disabled ? '' : '<lable class="col-1"></lable>' }
                </div>
            </div>`;
        template += Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].title, this.models[key].happen_at, disabled);
        })
        .join('')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, eventName, eventDateTime, disabled) {
        var controlButtons = '',
            eventName = new Input(index, 'title', eventName, disabled, 'Название события'),
            dateTime = new DateTime(index, 'happen_at', eventDateTime, disabled);

        eventName.init();
        dateTime.init();

        this.addListeners(eventName.getListeners());
        this.addListeners(dateTime.getListeners());
        this.mergeAdditionlClassesJQ(dateTime.getAdditionlClassesJQ());

        if (!disabled) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="row input-group bootstrap-touchspin mb-2">
                ${eventName.getTemplate()}
                ${dateTime.getTemplate()}
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
        this.saveAllModels();
    }
}
export default Countdown