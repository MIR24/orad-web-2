class Textarea {
    constructor (id, value, maxCharsPerLine) {
        this.template = '';
        this.id = id;
        this.value = value;
        this.maxCharsPerLine = maxCharsPerLine;
    }

    makeTemplate () {
        this.template = `<textarea class="form-control m-input m-input--air" id="${this.id}" rows="3" placeholder="Текст">${this.value}</textarea>`;
    }

    checkDisallowedCharacters (value) {
        const regexNotAllowed = new RegExp(/[^a-zA-Zа-яА-Я0-9\.\,\!\?\:\;\`\'\"\+\-\/\*\=\%\^\№\~\#\&\(\)\[\]\<\>\s]/),
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
            curVal = value.toUpperCase().replace(/(\r\n\t|\n|\r\t)/gm,"");

        if (inputType === "deleteContentBackward" || inputType === "deleteContentForward") {
            return false;
        }

        return curVal.replace(regexMaxChars, function (match) {
            return match + '\n';
        });
    }

    updateText (event) {
        var val = this.checkDisallowedCharacters(event.target.value),
            newVal = this.textAreaSplitLines(val, event.originalEvent.inputType),
            newSectionEnd = event.target.selectionEnd;

        if (newVal !== false) {
            val = newVal;
        }

        event.target.value = val;
        event.target.selectionEnd = newSectionEnd;
    }

    getTemplate () {
        return this.template;
    }

    init () {
        this.makeTemplate();
    }
}