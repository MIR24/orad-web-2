import { toastrMessages } from "../Config/Constants.js";
import BaseTab from "../BaseClasses/BaseTab.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import PhotoUploadEdit from "../Modals/PhotoUploadEdit.js"
import DeleteButton from "../Components/DeleteButton.js";
import Pagination from "../Groups/Pagination.js";
import SearchInline from "../Groups/SearchInline.js";

// TO DO
const testImg = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg';

class PhotoUpload extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = '',
            controlButtons = '',
            pagination = new Pagination(this.constructor.name, this.pagination),
            searchInline = new SearchInline(this.constructor.name, this.searchOptions);

        pagination.init();
        searchInline.init();

        this.addListeners(pagination.getListeners());
        this.addListeners(searchInline.getListeners());

        if (this.checkPermissions('create')) {
            var createModal = new PhotoUploadEdit('new', {}, 'create', {
                'premissions': this.premissions.allUpdateFieldPremissions,
            });
            
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

        if (this.checkPermissions('update')) {
            var editModal = new PhotoUploadEdit(index, this.models[index], 'edit', {
                'premissions': this.premissions.allUpdateFieldPremissions,
            });

            editModal.init();
            this.addListeners(editModal.getListeners());
            this.mergeAdditionlClassesJQ(editModal.getAdditionlClassesJQ());

            controlButtons = `${editModal.getOpenButton()}
                        ${editModal.getTemplate()}`;
        }

        if (this.checkPermissions('delete')) {
            var deleteModelBtn = new DeleteButton(index);
            deleteModelBtn.init();
            this.addListeners(deleteModelBtn.getListeners());
            controlButtons += deleteModelBtn.getTemplate();
        }

        return `<div id="${index}" class="col-4">
            <div class="m-portlet m-portlet--rounded m-portlet--bordered">
                <div class="m-portlet__body">
                    <div class="row pb-2">
                        <div class="col">
                            ${ this.models[index].path ? `<div class="container p-0">
                                <img width="250" src="${this.models[index].path}" alt="Фото не существует" >
                            </div>` : `<div class="col my-auto text-center">
                                <i class="flaticon-cancel w-100" style="font-size: 2.2em;"></i>
                                <br>
                                Фото не выбрано
                            </div>` }
                        </div>
                        <div class="col mt-2 mr-4">
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID</lable>
                                <lable class="col text-right">${(this.models[index].external_id !== undefined && this.models[index].external_id !== null) ? this.models[index].external_id : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Название</lable>
                                <lable class="col text-right">${this.models[index].name ? this.models[index].name : '-'}</lable>
                            </div>
                        </div>
                    </div>
                </div>
                ${controlButtons ? `<div class="m-portlet__foot">
                        <div class="row m--valign-middle">
                            <div class="col m--align-right">
                                ${controlButtons}
                            </div>
                        </div>
                    </div>` : ''}
            </div>
        </div>`;
    }

    modelChange (modelId, valueName, newValue) {
        this.updateEditState(modelId, valueName, newValue);
    }
}
export default PhotoUpload