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
const weatherIcons = {
    0: {
        'id': 0,
        'loc': 'https://png.pngtree.com/svg/20170227/test_356816.png',
        'text': 'text0'
    },
    1: {
        'id': 1,
        'loc': 'https://png.pngtree.com/svg/20170227/test_356816.png',
        'text': 'text1'
    },
    2: {
        'id': 2,
        'loc': 'https://png.pngtree.com/svg/20170227/test_356816.png',
        'text': 'text2'
    },
    3: {
        'id': 3,
        'loc': 'https://png.pngtree.com/svg/20170227/test_356816.png',
        'text': 'text3'
    },
};

class WeatherLive extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var disabled = this.edit.state == true ? '' : 'disabled',
            controlButtons = '';

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            // TO DO
            if (isAdmin) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }
        
        var template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].city, this.models[key].morning, this.models[key].evening, this.models[key].state, this.models[key].icon, disabled);
        })
        .join('')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, cityName, tempMorning, tempEvening, state, icon, disabled) {
        var controlButtons = '',
            cityName = new Input(index, 'city', cityName, disabled, 'City'),
            tempMorning = new Input(index, 'morning', tempMorning, disabled, '+0', 'number'),
            tempEvening = new Input(index, 'evening', tempEvening, disabled, '+0', 'number'),
            state = new Checkbox(index, 'state', state, disabled, 'Send to...'),
            selectWeather = new Select2Custom (index, 'icon', weatherIcons, icon.id, !this.edit.state);

        cityName.init();
        tempMorning.init();
        tempEvening.init();
        state.init();
        selectWeather.init();

        this.addListeners(cityName.getListeners());
        this.addListeners(tempMorning.getListeners());
        this.addListeners(tempEvening.getListeners());
        this.addListeners(state.getListeners());
        this.addAdditionlClassesJQ(index, selectWeather.getOptions());

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
        this.getMergedEditStateModels();
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