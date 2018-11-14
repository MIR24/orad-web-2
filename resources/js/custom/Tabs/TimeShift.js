import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";

class TimeShift extends BaseTab {
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

        var template = `<div class="row col-12 mb-2">
            <lable class="col">Город</lable>
            <lable class="col">Отступ</lable>
            ${ disabled ? '' : '<lable class="col-1"></lable>' }
        </div>`;
        template += Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].city, this.models[key].timeshift, disabled);
        })
        .join('')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, cityName, timeshift, disabled) {
        var controlButtons = '',
            cityName = new Input(index, 'city', cityName, disabled, 'City'),
            timeshift = new Input(index, 'timeshift', timeshift, disabled, '0', 'number');

        cityName.init();
        timeshift.init();

        this.addListeners(cityName.getListeners());
        this.addListeners(timeshift.getListeners());

        if (!disabled) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="row input-group bootstrap-touchspin mb-2">
                ${cityName.getTemplate()}
                ${timeshift.getTemplate()}
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
export default TimeShift