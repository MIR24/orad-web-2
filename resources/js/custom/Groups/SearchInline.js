import BaseComponentGroup from "../BaseClasses/BaseComponentGroup.js";
import SimpleButton from "../Components/SimpleButton.js";
import Input from "../Components/Input.js";

class SearchInline extends BaseComponentGroup {
    constructor (id, value) {
        super(id, 'search-inline', value);
    }

    makeTemplate () {
        var searchBtn = new SimpleButton(this.id, 'search-inline', 'btn'),
            searchInput = new Input(this.id, 'input', this.value.q, true, 'Поиск...', null, 'keypress');

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

    setValue (initClass, props, event) {console.log(event);
        this.value = event.target.value;
        if (event.originalEvent.charCode === 13) {
            initClass.searchModels(this.value);
        }
    }

    searchHandle (initClass, props, event) {
        initClass.searchModels(this.value);
    }
}
export default SearchInline