import { toasterMessages } from "../Config/Constants.js";
import BaseTab from "../BaseClasses/BaseTab.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import PromoEditModal from "../Modals/PromoEditModal.js"
import DeleteButton from "../Components/DeleteButton.js";
import Pagination from "../Groups/Pagination.js";
import SearchInline from "../Groups/SearchInline.js";

// TO DO
const testImg = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg';

class Promo extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = '',
            controlButtons = '',
            pagination = new Pagination(this.constructor.name, this.config.pagination),
            searchInline = new SearchInline(this.constructor.name, this.searchOptions);

        pagination.init();
        searchInline.init();

        this.addListeners(pagination.getListeners());
        this.addListeners(searchInline.getListeners());

        if (this.premisions.isLoggedIn && this.checkPermissions('create')) {
            var createModal = new PromoEditModal('new', {}, 'create', {'category': this.additions.category, 'mode': this.config.configModel.mode});
            
            createModal.init();
            this.addListeners(createModal.getListeners());
            this.mergeAdditionlClassesJQ(createModal.getAdditionlClassesJQ());
            controlButtons = `${createModal.getOpenButton()}${createModal.getTemplate()}`
        }

        template = Object.keys(this.models).map(key => {
            return this.makeBlock(key);
        })
        .join('');

        this.template = `<div class="row pb-5">
            <div class="input-group col-4">
				${searchInline.getTemplate()}
			</div>
            <div class="coll">
                ${controlButtons}
            </div>
        </div>
        <div  class="row justify-content">
            ${template}
        </div>
        ${pagination.getTemplate()}`;
    }

    makeBlock (index) {
        var controlButtons = '';

        if (this.premisions.isLoggedIn && this.checkPermissions('update')) {
            var editModal = new PromoEditModal(index, this.models[index], 'edit', {'category': this.additions.category, 'mode': this.config.configModel.mode}),
                btnTemplates = '';

            editModal.init();
            this.addListeners(editModal.getListeners());
            this.mergeAdditionlClassesJQ(editModal.getAdditionlClassesJQ());
            
            if (this.checkPermissions('delete')) {
                var deleteModelBtn = new DeleteButton(index);
                deleteModelBtn.init();
                this.addListeners(deleteModelBtn.getListeners());
                btnTemplates = deleteModelBtn.getTemplate();
            }

            controlButtons = `<div class="m-portlet__foot">
                <div class="row m--valign-middle">
                    <div class="col m--align-right">
                        ${editModal.getOpenButton()}
                        ${editModal.getTemplate()}
                        ${btnTemplates}
                    </div>
                </div>
            </div>`;
        }

        return `<div id="${index}" class="col-4">
            <div class="m-portlet m-portlet--rounded m-portlet--bordered">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                ${this.models[index].name}
                            </h3>
                        </div>			
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row pb-2">
                        <div class="col">
                            <div class="container p-0">
                                <img width="250" src="${testImg}">
                                <h4 class="position-absolute ml-4 mt-1 fixed-top text-light">${this.models[index].age ? this.models[index].age + '+' : '-'}</h4>
                            </div>
                        </div>
                        <div class="col mt-2 mr-4">
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИР</lable>
                                <lable class="col text-right">${this.models[index].mir_id !== undefined ? this.models[index].mir_id : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИРHD</lable>
                                <lable class="col text-right">${this.models[index].mirhd_id !== undefined ? this.models[index].mirhd_id : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Программа</lable>
                                <lable class="col text-right">${this.models[index].category ? this.models[index].category.text : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Режим</lable>
                                <lable class="col text-right">${this.models[index].mode !== undefined ? this.models[index].mode : '-'}</lable>
                            </div>
                        </div>
                    </div>
                </div>
                ${controlButtons}
            </div>
        </div>`;
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }
}
export default Promo