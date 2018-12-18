import BaseComponent from "../BaseClasses/BaseComponent.js";
import { textEditorConst, toastrMessages } from "../Config/Constants.js";
import Storage from "../Utils/Storage.js";

class TextEditor extends BaseComponent {
    constructor (id, valueName, value, maxCharsPerLine, disabled, placeholder) {
        super(id, valueName, 'input', disabled);
        this.placeholder = placeholder ? placeholder : 'Текст';
        this.value = Object.is(value, undefined) || Object.is(value, null) ? '' : value;
        this.maxCharsPerLine = maxCharsPerLine;
        this.highliteId = 'highlite-' + this.id;
    }

    makeTemplate () {
        this.template = `<div class="w-100 position-relative rounded ${ this.disabled ? 'bg-white' : 'bg-disabled-custom'}">
            <div class="texteditor-vertical-line"
                style="margin-left:${this.maxCharsPerLine * 10.15 + 13}px">
            </div>
            <div id="${this.highliteId}"
                class="texteditor-backgorund-highlite"
                contenteditable="true"
            >${this.highlightText(this.value)}</div>
            <textarea
            ${this.disabledString}
            class="p-3 form-control m-input texteditor"
            id="${this.id}"
            rows="${this.value ? this.value.split(/\r\n|\r|\n/).length + 1 : 3}"
            placeholder="${this.placeholder}"
            >${this.value}</textarea>
        </div>`;
    }

    getRandomColor() {
        var letters = '0123456789ABCDEF',
            color = '#';

        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }

        return color;
    }

    highlightText (text) {
        var frequency = text.split(/\s+/g).reduce(function(previous, current) {
            if (!previous.hasOwnProperty(current)) {
                previous[current] = 0;
            }
            previous[current] += 1;
            return previous;
        }, {});

        Object.keys(frequency).filter((element) => {
            if (frequency[element] > 1 && element.length >= 2) {
                var color = '',
                    storageType = 'color-' + element,
                    storageColor = Storage.getIfExits(this.id, storageType);

                if (storageColor) {
                    color = storageColor;
                } else {
                    color = this.getRandomColor();
                    Storage.put(this.id, {[storageType]: color});
                }

                text = text.replace(new RegExp(`(?<=^|\\s)(${element})(?=\\s|$)`, 'g'), `<mark style="background-color:${color}">$&</mark>`);
            }
        });
        return text;
    }

    handle (initClass, event) {
        const regexNotAllowed = new RegExp(textEditorConst.editTextLineAllowedCharsPattern, textEditorConst.editTextLineAllowedCharsFlag),
            selectionStartTemp = event.target.selectionStart,
            newValue = event.target.value.toUpperCase(),
            matches = newValue.match(regexNotAllowed);

        if (matches) {
            for (var index in matches) {
                toastr.error(toastrMessages.error.charNotAllowed + matches[index]);
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
        $('#' + this.highliteId).html(this.highlightText(event.target.value));
        initClass.modelChange(this.modelId, this.valueName, event.target.value);
    }
}
export default TextEditor