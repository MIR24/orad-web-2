class BaseComponent {
    constructor () {
        this.template = '';
        this.listeners = {};
    }

    makeTemplate () {}
    setListeners() {}

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
export default BaseComponent