import BaseTab from "../BaseClasses/BaseTab.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import PromoEditModal from "../Modals/PromoEditModal.js"
import DeleteButton from "../Components/DeleteButton.js";

// TO DO
const isSomeRoll = true;

class Promo extends BaseTab {
    constructor () {
        super();
        this.listeners = {
            'click' : {},
            'input' : {},
        };
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
            return this.makeBlock(
                key,
                this.models[key].mir_id,
                this.models[key].hd_id,
                this.models[key].category,
                this.models[key].name,
                this.models[key].title,
                this.models[key].underTitle,
                this.models[key].ageRestriction,
                this.models[key].state,
                this.models[key].image
            );
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

    makeBlock (index, mirId, hdId, category, name, title, underTitle, ageRestriction, state, imageSrc) {
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
                                ${name}
                            </h3>
                        </div>			
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row pb-2">
                        <div class="col">
                            <div class="container p-0">
                                <img width="250" src="${imageSrc}">
                                <h4 class="position-absolute ml-4 mt-1 fixed-top text-light">+${ageRestriction}</h4>
                            </div>
                        </div>
                        <div class="col mt-2 mr-4">
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИР</lable>
                                <lable class="col text-right">${mirId}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">ID МИРHD</lable>
                                <lable class="col text-right">${hdId}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Программа</lable>
                                <lable class="col text-right">${category}</lable>
                            </div>
                            <div class="row border-bottom mb-3">
                                <lable class="col">Режим</lable>
                                <lable class="col text-right">${state}</lable>
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
        console.log(this.edit[modelId]);
        this.edit = {
            'modelId': null,
            'state': false,
        }
        $('.modal-backdrop').remove();
        // TO DO
        this.rerender();
    }

    removeModel (modelId) {
        $('#' + modelId).remove();
        // TO DO
        //this.rerender();
        console.log(modelId);
    }
}
export default Promo