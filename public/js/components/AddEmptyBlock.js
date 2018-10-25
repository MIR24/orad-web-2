class AddEmptyBlock {
    constructor (id, text) {
        this.template = '';
        this.listeners = {
            'click': {}
        };
        this.id = IdManipulation.getPreparedId('add-empty-block', id);
        this.text = text ? text : '+ Добавить';
    }

    makeTemplate () {
        this.template = `<button id="${this.id}" class="btn btn-primary">${this.text}</button>`;
    }

    addEmptyBlock (initClass, event) {console.log(event, this, initClass);
        $(event.target).before(initClass.getEmptyBlock());
        initClass.initListeners();
    }

    setListeners () {
        Listeners.set(this, 'click', {
            [this.id]: {
                'function': this.addEmptyBlock,
                'class': this,
                'addInitClass': true,
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