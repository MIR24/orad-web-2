class AddEmptyBlock {
    constructor (id, text, parent) {
        this.template = '';
        this.listeners = {
            'click': {}
        };
        this.id = IdManipulation.getPreparedId('add-empty-block', id);
        this.text = text ? text : '+ Добавить';
        this.parent = parent;
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn btn-primary">${this.text}</button>`;
    }

    addEmptyBlock (event) {
        $(event.target).before(this.parent.getEmptyBlock());
        this.parent.initListeners();
    }

    setListeners () {
        Listeners.set(this, 'click', {
            [this.id]: {
                'function': this.addEmptyBlock,
                'class': this
            }
        });
    }

    getListeners () {
        return this.listeners;
    }
    
    getTemplate () {
        return this.template;
    }
    
    init () {
        this.setListeners();
        this.makeTemplate();
    }
}