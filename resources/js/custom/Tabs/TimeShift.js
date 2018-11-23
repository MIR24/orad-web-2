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
            controlButtons = '',
            tableBodyId = 'table-body-' + this.constructor.name;

        if (!disabled) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all'),
                addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, tableBodyId);

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

        var template = `<table class="table m-table m-table--head-no-border text-center">
            <thead>
                <tr>
                    <th>Город</th>
                    <th>Отступ</th>
                    ${ !disabled ? '<th></th>' : '' }
                </tr>
            </thead>
               <tbody id="${tableBodyId}">`;
        template += Object.keys(this.models).map(key => {
            if (this.edit.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, tempModel.errorModel.city, tempModel.errorModel.timeshift, disabled, tempModel.errorValidation);
            }
            return this.makeBlock(key, this.models[key].city, this.models[key].timeshift, disabled, {});
        })
        .join('');

        if (this.validation.hasOwnProperty('new')) {
            var tempModel = this.getValidatedObject('new');
            template = template.concat(
                this.makeBlock('new', tempModel.errorModel.city, tempModel.errorModel.timeshift, disabled, tempModel.errorValidation)
            );
        }

        template = template.concat('</tbody></table>')
        .concat(controlButtons);
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, cityName, timeshift, disabled, error) {
        var controlButtons = '',
            cityName = new Input(index, 'city', cityName, disabled, 'City'),
            timeshift = new Input(index, 'timeshift', timeshift, disabled, '0', 'number');

        cityName.init();
        timeshift.init();

        this.addListeners(cityName.getListeners());
        this.addListeners(timeshift.getListeners());

        if (!disabled) {
            var rmBtn = new DeleteButton(index);
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            <td>${this.getRow(cityName.getTemplate(), error.city)}</td>
            <td>${this.getRow(timeshift.getTemplate(), error.timeshift)}</td>
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
        return this.makeBlock('new', '', '', '', {});
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default TimeShift