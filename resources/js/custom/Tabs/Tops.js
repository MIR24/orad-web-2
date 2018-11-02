import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import Textarea from "../Components/Textarea.js";
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
            title = new Input(index, 'title', title, disabled, 'Заголовок'),
            textarea = new Textarea(index, 'strings', text, this.config.textMaxCharsPerLine, disabled),
            controlButtons = '';

        title.init();
        textarea.init();

        this.addListeners(textarea.getListeners());
        this.addListeners(title.getListeners());

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
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label">Заголовок</label>
                    ${title.getTemplate()}
                    <label>Текст</label>
                    ${textarea.getTemplate()}
                </div>
            </form>
        </div>`
    }
    
    getEmptyBlock () {
        this.eidting = {
            'modelId': 'new',
            'state': true,
        }
        return this.makeBlock('new', '', '');
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }

    saveModel (modelId) {
        console.log(this.edit[modelId]);
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
export default Tops