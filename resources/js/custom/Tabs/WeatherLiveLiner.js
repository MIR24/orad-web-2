import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";
import Checkbox from "../Components/Checkbox.js";
import Select2Custom from "../ExternalComponents/Select2Custom.js";

class WeatherLiveLiner extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var controlButtons = '',
            tableBodyId = 'table-body-' + this.constructor.name;

        if (this.edit.state) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            if (this.checkPermissions('create') || this.checkPermissions('create')) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, tableBodyId);
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else if (this.checkPermissions('update')) {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }

        var template = `<table class="table m-table m-table--head-no-border text-center">
            <thead>
                <tr>
                    <th>Город</th>
                    <th>Температура сейчас</th>
                    <th>Температура утром</th>
                    <th>Температура вечером</th>
                    <th>Иконка</th>
                    <th></th>
                    ${ !this.edit.state && this.checkPermissions('delete') ? '<th></th>' : '' }
                </tr>
            </thead>
               <tbody id="${tableBodyId}">`;
        template += Object.keys(this.models).map(key => {
            if (this.edit.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, tempModel.errorModel.city, tempModel.errorModel.now, tempModel.errorModel.morning, tempModel.errorModel.evening, tempModel.errorModel.status, tempModel.errorModel.weather_type_id, tempModel.errorValidation);
            }
           return this.makeBlock(key, this.models[key].city, this.models[key].now, this.models[key].morning, this.models[key].evening, this.models[key].status, this.models[key].weather_type_id, {});
        })
        .join('');

        if (this.validation.hasOwnProperty('new')) {
            var tempModel = this.getValidatedObject('new');
            template = template.concat(
                this.makeBlock('new', tempModel.errorModel.city, tempModel.errorModel.now, tempModel.errorModel.morning, tempModel.errorModel.evening, tempModel.errorModel.status, tempModel.errorModel.weather_type_id, tempModel.errorValidation)
            );
        }

        template = template.concat('</tbody></table>')
        .concat(controlButtons);
        this.template = this.getBaseContainerFullWidth(template);
    }

    makeBlock (index, cityName, tempNow, tempMorning, tempEvening, status, weather_type_id, error) {
        var controlButtons = '',
            cityName = new Input(index, 'city', cityName, this.checkPermissionsField('city'), 'City'),
            tempNow = new Input(index, 'now', tempNow, this.checkPermissionsField('now'), '+0', 'number'),
            tempMorning = new Input(index, 'morning', tempMorning, this.checkPermissionsField('morning'), '+0', 'number'),
            tempEvening = new Input(index, 'evening', tempEvening, this.checkPermissionsField('evening'), '+0', 'number'),
            status = new Checkbox(index, 'status', status === 'active' ? true : false, this.checkPermissionsField('status'), 'Активно'),
            selectWeather = new Select2Custom (index, 'weather_type_id', this.additions.weatherTypes, weather_type_id, this.checkPermissionsField('weather_type_id'), this.constructor.name);

        cityName.init();
        tempNow.init();
        tempMorning.init();
        tempEvening.init();
        status.init();
        selectWeather.init();

        this.addListeners(cityName.getListeners());
        this.addListeners(tempNow.getListeners());
        this.addListeners(tempMorning.getListeners());
        this.addListeners(tempEvening.getListeners());
        this.addListeners(status.getListeners());
        this.addAdditionlClassesJQ(index, selectWeather);

        if (!this.edit.state && this.checkPermissions('delete')) {
            var rmBtn = new DeleteButton(index);
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            <td>${this.getRow(cityName.getTemplate(), error.city)}</td>
            <td>${this.getRow(tempNow.getTemplate(), error.now)}</td>
            <td>${this.getRow(tempMorning.getTemplate(), error.morning)}</td>
            <td>${this.getRow(tempEvening.getTemplate(), error.evening)}</td>
            <td>
                    ${selectWeather.getTemplate()}
            </td>
            <td>
                <div class="form-control">
                    ${status.getTemplate()}
                </div>
            </td>
            ${controlButtons}
        </tr>`;
    }

    getRow (elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group has-danger mb-0">
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group">
                ${elementTemplate}
            </div>`;
        }
    }

    getEmptyBlock () {
        return this.makeBlock('new', '', '', '', '', '', '', {});
    }

    modelChange (modelId, valueName, newValue) {
        if (this.config.switchValue.hasOwnProperty(valueName)) {
            newValue = this.config.switchValue[valueName][newValue];
        }
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default WeatherLiveLiner