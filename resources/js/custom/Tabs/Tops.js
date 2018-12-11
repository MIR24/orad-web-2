import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import TextEditor from "../Components/TextEditor.js";
import IdManipulation from "../Utils/IdManipulation.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";

class Tops extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = Object.keys(this.models).map(key => {
            if (this.validation.hasOwnProperty(key)) {
                var tempModel = this.getValidatedObject(key);
                return this.makeBlock(key, tempModel.errorModel.text, tempModel.errorModel.strings, tempModel.errorValidation);
            }
            return this.makeBlock(key, this.models[key].text, this.models[key].strings, {});
        })
        .join('');

        if (this.validation.hasOwnProperty('new')) {
            var tempModel = this.getValidatedObject('new');
            template = template.concat(
                this.makeBlock('new', tempModel.errorModel.text, tempModel.errorModel.strings, tempModel.errorValidation)
            );
        }

        if (!this.edit.state && this.checkPermissions('create')) {
            var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
            addEmptyBlockButton.init();
            this.addListeners(addEmptyBlockButton.getListeners());
            template = template.concat(addEmptyBlockButton.getTemplate());
        }
        this.template = this.getBaseContainerFullWidth(template);
    }

    makeBlock (index, title, text, error) {
        var title = new Input(index, 'text', title, this.checkPermissionsField('text', index), 'Заголовок'),
            textarea = new TextEditor(index, 'strings', text, this.config.textMaxCharsPerLine, this.checkPermissionsField('strings', index)),
            controlButtons = '';

        title.init();
        textarea.init();

        this.addListeners(textarea.getListeners());
        this.addListeners(title.getListeners());

        if (this.edit.modelId == index || index === 'new') {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelEditingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            if (this.checkPermissions('update')) {
                var enterRedactingBtn = new EnterEditingButton(index);
                enterRedactingBtn.init();
                this.addListeners(enterRedactingBtn.getListeners());
                controlButtons = enterRedactingBtn.getTemplate();
            }

            if (this.checkPermissions('delete')) {
                var rmBtn = new DeleteButton(index);
                rmBtn.init();
                this.addListeners(rmBtn.getListeners());
                controlButtons += rmBtn.getTemplate();
            }
        }

        return `<div id="${index}" class="col-12 p-0 m-portlet bg-secondary m-portlet--bordered m-portlet--rounded">
            ${ controlButtons ? `<div class="m-portlet__head p-0">
                <div class="row col align-items-center">
                    <div class="col-6"></div>
                    <div class="col-6 m--align-right">
                        ${controlButtons}
                    </div>
                </div>
            </div>`: '' }
            <div class="m-portlet__body">
                <form class="m-form m-form--fit m-form--label-align-right">
                    ${this.getRow('Заголовок', title.getTemplate(), error.text)}
                    ${this.getRow('Текст', textarea.getTemplate(), error.strings)}
                </form>
            </div>
        </div>`
    }

    getRow (label, elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group row has-danger">
                <label>${label}</label>
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group row">
                <label>${label}</label>
                ${elementTemplate}
            </div>`;
        }
    }

    getEmptyBlock () {
        this.edit = {
            'modelId': 'new',
            'state': true,
        };
        return this.makeBlock('new', '', '', {});
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        this.saveOneModel(modelId);
    }
}
export default Tops