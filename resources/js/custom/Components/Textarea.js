import BaseComponent from "../BaseClasses/BaseComponent.js";
import Listeners from "../Utils/Listeners.js";
import IdManipulation from "../Utils/IdManipulation.js";

class Textarea extends BaseComponent {
    constructor (id, valueName, value, maxCharsPerLine, disabled, placeholder) {
        super(id, valueName, 'input', disabled);
        this.placeholder = placeholder ? placeholder : 'Текст';
        this.value = Object.is(value, undefined) ? '' : value;
        this.maxCharsPerLine = maxCharsPerLine;
    }

    makeTemplate () {
        this.template = `<textarea ${this.disabled} class="form-control m-input m-input--air" id="${this.id}" rows="${this.value.split(/\r\n|\r|\n/).length}" placeholder="${this.placeholder}">${this.value}</textarea>`;
    }

    checkDisallowedCharacters (value) {
        const regexNotAllowed = new RegExp(/[^a-zA-Zа-яА-ЯёЁ0-9\.\,\!\?\:\;\`\'\"\+\-\/\*\=\%\^\№\~\#\&\(\)\[\]\<\>\s]/),
         matches = regexNotAllowed.exec(value);
        if (matches) {
            var error = 'Chars not allowed: ' + matches[0];
            alert(error);
            return value.replace(regexNotAllowed, "");
        }
        return value;
    }

    textAreaSplitLines (value, inputType) {
        const regexMaxChars = new RegExp(`.{${this.maxCharsPerLine}}`, 'gm'),
            curVal = value.toUpperCase();

        if (inputType === "deleteContentBackward" || inputType === "deleteContentForward") {
            return false;
        }

        return curVal.replace(regexMaxChars, function (match) {
            return match + '\n';
        });
    }

    deleteEmptyLines (string) {
        return string.replace(/^\s*$(?:\r\n?|\n)/gm,"");
    }

    handle (initClass, event) {
        var val = this.checkDisallowedCharacters(event.target.value),
            newVal = this.textAreaSplitLines(val, event.originalEvent.inputType),
            newSectionEnd = event.target.selectionEnd;

        if (newVal !== false) {
            event.target.value = this.deleteEmptyLines(newVal);
            if (newVal.charAt(newSectionEnd) == '\n') {
                event.target.selectionEnd = newSectionEnd + 1;
            } else {
                event.target.selectionEnd = newSectionEnd;
            }
        } else {
            event.target.value = this.deleteEmptyLines(val);
        }
        event.target.style.height = '1px';
        event.target.style.height = (20 + event.target.scrollHeight) + 'px';
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default Textarea