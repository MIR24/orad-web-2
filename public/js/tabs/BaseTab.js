class BaseTab {
    constructor () {
        this.csrf = $('meta[name="csrf-token"]').attr('content');
        this.template = '';
    }

    getModels () {
        return new Promise ((resolve, reject) => {
            $.ajax({
                headers: {
                    'X-CSRF-Token': this.csrf
                },
                url: this.url,
                method: 'GET',
                success: data => {
                    resolve(data);
                },
                error: e => {
                    alert(e.message);
                    bodyLoader.removeClass('m-page--loading');
                },
            });
        });
    }

    makeTemplate (response) {}
    
    addListeners () {
        for (var type in this.listeners) {
            for (var key in this.listeners[type]) {
                $('#' + key).bind(type, this.listeners[type][key]);
                delete this.listeners[type][key];
            }
        }
    }

    renderTemplate () {
        tabContentContainer.html(this.template);
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
        const regexMaxChars = new RegExp(`.{${this.textareaMaxCharsPerLine}}`, 'gm'),
            curVal = value.toUpperCase().replace(/(\r\n\t|\n|\r\t)/gm,"");

        if (inputType === "deleteContentBackward" || inputType === "deleteContentForward") {
            return false;
        }

        return curVal.replace(regexMaxChars, function (match) {
            return match + '\n';
        });
    }

    init () {
        bodyLoader.addClass('m-page--loading');
        this.getModels()
        .then((response) => {
            this.makeTemplate(response);
            this.renderTemplate();
            this.addListeners();
        })
        .then(function () {
            bodyLoader.removeClass('m-page--loading');
        });
    }
}