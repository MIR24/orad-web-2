import BaseComponent from "../BaseClasses/BaseComponent.js";
import Listeners from "../Utils/Listeners.js";
import IdManipulation from "../Utils/IdManipulation.js";
import { editTextLineAllowedChars, toasterMessages } from "../Config/Constants.js";

class Textarea extends BaseComponent {
    constructor (id, valueName, value, maxCharsPerLine, disabled, placeholder) {
        super(id, valueName, 'input', disabled);
        this.placeholder = placeholder ? placeholder : 'Текст';
        this.value = Object.is(value, undefined) ? '' : value;
        this.maxCharsPerLine = maxCharsPerLine;
    }

    makeTemplate () {
        this.template = `<div class="w-100 position-relative">
            <div class="textarea-vertical-line"
                style="margin-left:${(this.maxCharsPerLine + 1) * 10 + 17}px">
            </div>
            <textarea
            ${this.disabled}
            class="form-control m-input m-input--air"
            id="${this.id}"
            rows="${this.value.split(/\r\n|\r|\n/).length + 1}"
            placeholder="${this.placeholder}"
            style="font-family: monospace;"
            >${this.value}</textarea>
        </div>`;
    }

    checkDisallowedCharacters (value) {
        const regexNotAllowed = new RegExp(editTextLineAllowedChars),
         matches = regexNotAllowed.exec(value);
        if (matches) {
            toastr.error(toasterMessages.error.charNotAllowed + matches[0]);
            return value.replace(regexNotAllowed, "");
        }
        return value;
    }

    handle (initClass, event) {
        event.target.value = this.checkDisallowedCharacters(event.target.value.toUpperCase());
        event.target.style.height = '1px';
        event.target.style.height = (20 + event.target.scrollHeight) + 'px';
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default Textarea