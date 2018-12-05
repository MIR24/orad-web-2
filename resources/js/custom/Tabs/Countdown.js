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
        var controlButtons = '',
            tableBodyId = 'table-body-' + this.constructor.name;;

        if (this.edit.state) {
            var saveBtn = new SaveButton('all'),
                cancelEditBtn = new CancelEditingButton('all');

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            if (this.checkPermissions('create')) {
                var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name, !this.edit.hasOwnProperty('new'), tableBodyId);
                this.addEmptyBlockButtonId = addEmptyBlockButton.id;
                addEmptyBlockButton.init();
                this.addListeners(addEmptyBlockButton.getListeners());
                controlButtons = addEmptyBlockButton.getTemplate();
            }

            controlButtons += `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else if (this.checkPermissions('update') || this.checkPermissions('create')) {
            var enterRedactingBtn = new EnterEditingButton(this.constructor.name);

            enterRedactingBtn.init();
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = enterRedactingBtn.getTemplate();
        }

        var template = `<table class="table m-table m-table--head-no-border text-center">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата и время</th>
                    ${ !this.edit.state && this.checkPermissions('delete') ? '<th></th>' : '' }
                </tr>
            </thead>
               <tbody id="${tableBodyId}">`;
       template += Object.keys(this.models).map(key => {
           if (this.edit.hasOwnProperty(key)) {
               var tempModel = this.getValidatedObject(key);
               return this.makeBlock(key, tempModel.errorModel.title, tempModel.errorModel.happen_at, tempModel.errorValidation);
           }
           return this.makeBlock(key, this.models[key].title, this.models[key].happen_at, {});
       })
       .join('');

        if (this.validation.hasOwnProperty('new')) {
           var tempModel = this.getValidatedObject('new');
           template = template.concat(
               this.makeBlock('new', tempModel.errorModel.title, tempModel.errorModel.happen_at, tempModel.errorValidation)
           );
        }

       template = template.concat('</tbody></table>')
       .concat(controlButtons);
       this.template = this.getBaseContainer(template);
    }

    makeBlock (index, eventName, eventDateTime, error) {
        var controlButtons = '',
            eventName = new Input(index, 'title', eventName, this.checkPermissionsField('title'), 'Название события'),
            dateTime = new DateTime(index, 'happen_at', eventDateTime, this.checkPermissionsField('happen_at'));

        eventName.init();
        dateTime.init();

        this.addListeners(eventName.getListeners());
        this.addListeners(dateTime.getListeners());
        this.mergeAdditionlClassesJQ(dateTime.getAdditionlClassesJQ());

        if (!this.edit.state && this.checkPermissions('delete')) {
            var rmBtn = new DeleteButton(index);
            rmBtn.init();
            this.addListeners(rmBtn.getListeners());
            controlButtons = `<td>${rmBtn.getTemplate()}</td>`;
        }

        return `<tr id="${index}">
            <td>${this.getRow(eventName.getTemplate(), error.title)}</td>
            <td>${this.getRow(dateTime.getTemplate(), error.happen_at)}</td>
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
            return `<div class="input-group">
                ${elementTemplate}
            </div>`;
        }
    }

    getEmptyBlock () {
        return this.makeBlock('new', '', '', {});
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveAllModels();
    }
}
export default Countdown