import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";
import Checkbox from "../Components/Checkbox.js";
import Select2Custom from "../ExternalComponents/Select2Custom.js";

// TO DO
const isAdmin = true;

class WeatherLive extends BaseTab {
    constructor () {
        super();
        this.url = '/test/weatherlive';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '';

        if (!disabled) {
            var saveBtn = new SaveButton('all');

            saveBtn.init();
            this.addListeners(saveBtn.getListeners());

            // TO DO
            if (isAdmin) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += saveBtn.getTemplate();
        } else {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }
        
        this.template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].city, this.models[key].morning, this.models[key].evening, this.models[key].state, this.models[key].icon, disabled);
        })
        .join('')
        .concat(controlButtons);
    }

    makeBlock (index, cityName, tempMorning, tempEvening, state, icon, disabled) {
        var controlButtons = '',
            cityName = new Input(index, 'city', cityName, disabled, 'City'),
            tempMorning = new Input(index, 'morning', tempMorning, disabled, '+0', 'number'),
            tempEvening = new Input(index, 'evening', tempMorning, disabled, '+0', 'number'),
            state = new Checkbox(index, 'state', state, disabled, 'Send to...'),
            selectWeather = new Select2Custom (index, 'selectWeather', !this.edit.state);

        cityName.init();
        tempMorning.init();
        tempEvening.init();
        state.init();
        selectWeather.init();

        this.addListeners(cityName.getListeners());
        this.addListeners(tempMorning.getListeners());
        this.addListeners(tempEvening.getListeners());
        this.addListeners(state.getListeners());
        this.addAdditionlClassesJQ(selectWeather.getOptions());

        // TO DO
        if (!disabled && isAdmin) {
            var rmBtn = new DeleteButton(index, 'delete-button-CurrencyValues');
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = rmBtn.getTemplate();
        }

        return `<div id="${index}" class="col-12 row justify-content-center">
            <div class="row input-group bootstrap-touchspin mb-2">
                ${cityName.getTemplate()}
                ${tempMorning.getTemplate()}
                ${tempEvening.getTemplate()}
                ${selectWeather.getTemplate()}
                <div class="form-control">
                    ${state.getTemplate()}
                </div>
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
export default WeatherLive