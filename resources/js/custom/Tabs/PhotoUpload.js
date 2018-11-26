import { toasterMessages } from "../Config/Constants.js";
import BaseTab from "../BaseClasses/BaseTab.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import PhotoUploadEdit from "../Modals/PhotoUploadEdit.js"
import DeleteButton from "../Components/DeleteButton.js";
import Pagination from "../Groups/Pagination.js";
import SearchInline from "../Groups/SearchInline.js";

// TO DO
const isSomeRoll = true,
    testImg = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg';

class PhotoUpload extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = '',
            controlButtons = '',
            //pagination = new Pagination(this.constructor.name, this.config.pagination),
            searchInline = new SearchInline(this.constructor.name, this.searchOptions);

        //pagination.init();
        searchInline.init();

        //this.addListeners(pagination.getListeners());
        this.addListeners(searchInline.getListeners());

        // TO DO
        if (isSomeRoll) {
            var createModal = new PhotoUploadEdit('new', {}, 'create');
            
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
        </div>`;
    }

    makeBlock (index) {
        var controlButtons = '';

        // TO DO
        if (isSomeRoll) {
            var editModal = new PhotoUploadEdit(index, this.models[index], 'edit'),
                deleteModelBtn = new DeleteButton(index);

            editModal.init();
            deleteModelBtn.init();

            this.addListeners(editModal.getListeners());
            this.addListeners(deleteModelBtn.getListeners());

            this.mergeAdditionlClassesJQ(editModal.getAdditionlClassesJQ());

            controlButtons = `<div class="m-portlet__foot">
                <div class="row m--valign-middle">
                    <div class="col m--align-right">
                        ${editModal.getOpenButton()}
                        ${editModal.getTemplate()}
                        ${deleteModelBtn.getTemplate()}
                    </div>
                </div>
            </div>`;
        }

        return `<div id="${index}" class="col-4">
            <div class="m-portlet m-portlet--rounded m-portlet--bordered">
                <div class="m-portlet__body">
                    <div class="row pb-2">
                        <div class="col">
                            <div class="container p-0">
                                <img width="250" src="${testImg}">
                            </div>
                        </div>
                        <div class="col mt-2 mr-4">
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID</lable>
                                <lable class="col text-right">${this.models[index].customId !== undefined ? this.models[index].customId : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Название</lable>
                                <lable class="col text-right">${this.models[index].name ? this.models[index].name : '-'}</lable>
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
export default PhotoUpload