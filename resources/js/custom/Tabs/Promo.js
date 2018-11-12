import BaseTab from "../BaseClasses/BaseTab.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import PromoEditModal from "../Modals/PromoEditModal.js"
import DeleteButton from "../Components/DeleteButton.js";

// TO DO
const isSomeRoll = true,
    testImg = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg';

class Promo extends BaseTab {
    constructor () {
        super();
    }

    makeTemplate () {
        var template = '',
            controlButtons = '';

        // TO DO
        if (isSomeRoll) {
            var createModal = new PromoEditModal('new', {}, 'create');
            
            createModal.init();
            this.addListeners(createModal.getListeners());
            controlButtons = `${createModal.getOpenButton()}${createModal.getTemplate()}`
        }

        template = Object.keys(this.models).map(key => {
            return this.makeBlock(key);
        })
        .join('');

        this.template = `<div class="row pb-5">
            <div class="input-group col-4">
				<input type="text" class="form-control" placeholder="Поиск...">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
                        <i class="la la-search"></i>
                    </button>
				</div>
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
            var editModal = new PromoEditModal(index, this.models[index], 'edit'),
                deleteModelBtn = new DeleteButton(index);

            editModal.init();
            deleteModelBtn.init();

            this.addListeners(editModal.getListeners());
            this.addListeners(deleteModelBtn.getListeners());
            
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
                                <h4 class="position-absolute ml-4 mt-1 fixed-top text-light">${this.models[index].age ? '+' + this.models[index].age: '-'}</h4>
                            </div>
                        </div>
                        <div class="col mt-2 mr-4">
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИР</lable>
                                <lable class="col text-right">${this.models[index].mir_id ? this.models[index].mir_id : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИРHD</lable>
                                <lable class="col text-right">${this.models[index].mirhd_id ? this.models[index].mirhd_id : '-'}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Программа</lable>
                                <lable class="col text-right">${this.models[index].category.text}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Режим</lable>
                                <lable class="col text-right">${this.models[index].mode ? this.models[index].mode : '-'}</lable>
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

    saveModel (modelId) {
        if (modelId === 'new') {
            this.createModels(this.getNewEditStateModel())
            .then((response) => {
                this.edit = {
                    'modelId': null,
                    'state': false,
                };
                this.models = Object.assign(this.models, {[response.data.id]: response.data});
                $('body').css('padding-right','0px')
                $('.modal-backdrop').remove();
                this.rerender();
            });
        } else {
            var models = this.getMergedEditStateModels();
            if (models.length > 0) {
                this.updateModels(models)
                .then((response) => {
                    this.edit = {
                        'modelId': null,
                        'state': false,
                    };
                    this.models[modelId] = Object.assign(this.models[modelId], response[0]);
                    $('body').css('padding-right','0px')
                    $('.modal-backdrop').remove();
                    this.rerender();
                });
            } else {
                alert('no changes made');
            }
        }
    }

    removeModel (modelId) {
        this.deleteModel(this.models[modelId].id)
        .then((response) => {
            if (this.edit.hasOwnProperty(modelId)) {
                delete this.edit[modelId];
            }
            $('#' + modelId).remove();
            delete this.models[modelId];
            this.rerender();
        });
    }
}
export default Promo