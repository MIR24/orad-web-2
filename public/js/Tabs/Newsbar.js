import BaseTab from "../BaseClasses/BaseTab.js";
import Textarea from "../Components/Textarea.js";
import SpinnerButton from "../Utils/IdManipulation.js";
import IdManipulation from "../Utils/IdManipulation.js";
import SaveButton from "../Components/SaveButton.js";

class Newsbar extends BaseTab {
    constructor () {
        super();
        this.url = '/test/newsbar';
        this.textareaMaxCharsPerLine = 6;
        this.listeners = {
            'click' : {},
            'input' : {},
        };
        this.names = {
            0: 'Топы',
            1: 'Бегущая строка',
        };
    }

    makeTemplate () {
        this.template = Object.keys(this.models).map(key => {
            var text = Object.keys(this.models[key].releated).map(keyInner => (
                this.models[key].releated[keyInner].text
            )).join('\n');
            return this.makeBlock(key, this.models[key].title, text);
        })
        .join('');
    }

    makeBlock (index, title, text) {
        var titleId = IdManipulation.getPreparedId('title', index),
            textareaId = IdManipulation.getPreparedId('textarea', index),
            textarea = new Textarea(textareaId, text, this.textareaMaxCharsPerLine),
            saveBtn = new SaveButton(index);

        textarea.init();
        saveBtn.init();

        this.addListeners(saveBtn.getListeners());
        this.setListeners('input', {
            [titleId]: {
                'function': this.updateTitle,
                'class': this
            },
            [textareaId]: {
                'function': textarea.updateText,
                'class': textarea
            },
        });

        return `<div class="col-12 mb-5 p-5 bg-secondary rounded">
            <div class="text-right">
                ${saveBtn.getTemplate()}
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="form-group m-form__group">
                    <label for="${textareaId}">${this.names[index]}</label>
                    ${textarea.getTemplate()}
                </div>
            </form>
        </div>`
    }

    updateTitle (event) {
        console.log(event.target.value);
    }

    saveModel (stringId) {
        var modelId = IdManipulation.getIdFromString(stringId);
        console.log(modelId);
    }
}
export default Newsbar