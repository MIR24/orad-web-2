import BaseComponent from "../BaseClasses/BaseComponent.js";
import { editTextLineAllowedChars, toasterMessages } from "../Config/Constants.js";

class TextEditor extends BaseComponent {
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
            ${this.disabledString}
            class="form-control m-input m-input--air"
            id="${this.id}"
            rows="${this.value.split(/\r\n|\r|\n/).length + 1}"
            placeholder="${this.placeholder}"
            style="font-family: monospace;"
            >${this.value}</textarea>
        </div>`;
    }

    handle (initClass, event) {
        const regexNotAllowed = new RegExp(editTextLineAllowedChars, 'g'),
            selectionStartTemp = event.target.selectionStart,
            newValue = event.target.value.toUpperCase(),
            matches = newValue.match(regexNotAllowed);

        if (matches) {
            for (var index in matches) {
                toastr.error(toasterMessages.error.charNotAllowed + matches[index]);
            }

            event.target.value = newValue.replace(regexNotAllowed, "");
            event.target.selectionStart = selectionStartTemp - matches.length;
        } else {
            event.target.value = newValue;
            event.target.selectionStart = selectionStartTemp;
        }

        event.target.selectionEnd = event.target.selectionStart;
        event.target.style.height = '1px';
        event.target.style.height = (20 + event.target.scrollHeight) + 'px';
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default TextEditor