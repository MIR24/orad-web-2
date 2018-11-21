import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import SimpleButton from "../Components/SimpleButton.js";
import Input from "../Components/Input.js";

class SearchInline extends BaseComponentGroup {
    constructor (id, value) {
        super(id, 'search-inline', value);
    }

    makeTemplate () {
        var searchBtn = new SimpleButton(this.id, 'search-inline', 'btn', false),
            searchInput = new Input(this.id, 'input', this.value.q, false, 'Поиск...');

        searchBtn.init();
        searchInput.init();

        searchBtn.setNewHandle(this, this.__proto__.searchHandle);
        searchInput.setNewHandle(this, this.__proto__.setValue);

        this.addListeners(searchBtn.getListeners());
        this.addListeners(searchInput.getListeners());

        this.template = `${searchInput.getTemplate()}
        <div class="input-group-append">
            ${searchBtn.getTemplate()}
        </div>`;
    }

    setValue (initClass, props, event) {
        this.value = event.target.value;
    }

    searchHandle (initClass, props, event) {
        initClass.searchModels(this.value);
    }
}
export default SearchInline