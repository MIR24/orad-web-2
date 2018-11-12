import BaseTab from "../BaseClasses/BaseTab.js";
import ExpeditedCheckbox from "../Groups/ExpeditedCheckbox.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import Textarea from "../Components/Textarea.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";
import Input from "../Components/Input.js";

class Expedited extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = Object.keys(this.models).map(key => {
            return this.makeBlock(key, this.models[key].text, this.models[key].strings);
        })
        .join('');

        if (!this.edit.state) {
            var addEmptyBlockButton = new AddEmptyBlockButton(this.constructor.name);
            addEmptyBlockButton.init();
            this.addListeners(addEmptyBlockButton.getListeners());
            template = template.concat(addEmptyBlockButton.getTemplate());
        }
        this.template = this.getBaseContainer(template);
    }

    makeBlock (index, title, text) {
        var disabled = this.edit.modelId == index || index === 'new' ? '' : 'disabled',
            title = new Input(index, 'text', title, disabled, 'Заголовок'),
            textarea = new Textarea(index, 'strings', text, this.config.textMaxCharsPerLine, disabled),
            checkboxes = new ExpeditedCheckbox(index, 'orbits', this.additions.orbits, disabled),
            controlButtons = '';

        title.init();
        textarea.init()
        checkboxes.init();

        this.addListeners(title.getListeners());
        this.addListeners(textarea.getListeners());
        this.addListeners(checkboxes.getListeners());

        if (!disabled) {
            var saveBtn = new SaveButton(index),
                cancelEditBtn = new CancelEditingButton(index);

            saveBtn.init();
            cancelEditBtn.init();

            this.addListeners(saveBtn.getListeners());
            this.addListeners(cancelEditBtn.getListeners());

            controlButtons = `${saveBtn.getTemplate()}${cancelEditBtn.getTemplate()}`;
        } else {
            var rmBtn = new DeleteButton(index),
                enterRedactingBtn = new EnterEditingButton(index);

            rmBtn.init();
            enterRedactingBtn.init();

            this.addListeners(rmBtn.getListeners());
            this.addListeners(enterRedactingBtn.getListeners());

            controlButtons = `${enterRedactingBtn.getTemplate()}${rmBtn.getTemplate()}`;
        }

        return `<div id="${index}" class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${controlButtons}
            </div>
            <div class="row">
                <form class="col-md-10 m-form m-form--fit m-form--label-align-right">
                    <div class="form-group m-form__group">
                        <label>Заголовок</label>
                        ${title.getTemplate()}
                        <label>Текст</label>
                        ${textarea.getTemplate()}
                    </div>
                </form>
                <form class="col-md-2 pt-4 p-0 m-form m-form--fit m-form--label-align-right">
                    ${checkboxes.getTemplate()}
                </form>
            </div>
        </div>`
    }

    getEmptyBlock () {
        this.eidting = {
            'modelId': 'new',
            'state': true,
        }
        return this.makeBlock('new');
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        if (modelId === 'new') {
            this.createModels(this.edit.new)
            .then((response) => {
                this.edit = {
                    'modelId': null,
                    'state': false,
                };
                this.models = Object.assign(this.models, {[response.data.id]: response.data});
                this.rerender();
            });
        } else {
            var models = this.getMergedEditStateModels();
            if (models.length > 0) {
                this.updateModels(models)
                .then((response) => {
                    this.edit = {
                        'modelId': null,
                        'state': false,
                    };
                    this.models[modelId] = Object.assign(this.models[modelId], response[0]);
                    this.rerender();
                });
            } else {
                alert('no changes made');
            }
        }
    }

    removeModel (modelId) {
        this.deleteModel(this.models[modelId].id)
        .then((response) => {
            if (this.edit.hasOwnProperty(modelId)) {
                delete this.edit[modelId];
            }
            $('#' + modelId).remove();
            delete this.models[modelId];
            this.rerender();
        });
    }
}
export default Expedited