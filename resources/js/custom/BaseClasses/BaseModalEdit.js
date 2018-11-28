import BaseModal from "../BaseClasses/BaseModal.js";
import ModalEnterEditButton from "../Components/ModalEnterEditButton.js";
import SimpleButton from "../Components/SimpleButton.js";
import AdditionlClassesJQ from "../Utils/AdditionlClassesJQ.js";

class BaseModalEdit extends BaseModal {
    constructor (id, type, model, additions) {
        super(id, type, model);
        this.validationModel = {};
        this.additions = additions;
        this.additionlClassesJQ = {};
    }

    getBaseTemplate () {
        var openButton = new ModalEnterEditButton(this.modelId, this.config.enterEditBtn, this.id),
            exitEditButton = new SimpleButton(this.modelId, 'modal-exit-edit'),
            exitEditButtonTop = new SimpleButton(this.modelId, 'modal-exit-edit-top'),
            saveButton = new SimpleButton(this.modelId, 'modal-save-edit');

        openButton.init();
        exitEditButton.init();
        exitEditButtonTop.init();
        saveButton.init();

        this.addListeners(openButton.getListeners());
        exitEditButton.setNewHandle(this, this.__proto__.__proto__.exitEditHandle);
        exitEditButtonTop.setNewHandle(this, this.__proto__.__proto__.exitEditHandle);
        saveButton.setNewHandle(this, this.__proto__.__proto__.saveModelHandle);

        this.addListeners(exitEditButton.getListeners());
        this.addListeners(exitEditButtonTop.getListeners());
        this.addListeners(saveButton.getListeners());
        this.openButton = openButton.getTemplate();

        return `<div class="modal fade" id="${this.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div id="${this.modalContentId}" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">${this.config.modalTitle}</h5>
                        ${exitEditButtonTop.getTemplate()}
                    </div>
                    <div id=${this.modalBodyId} class="modal-body">
                        ${this.modalBody}
                    </div>
                    <div class="modal-footer">
                        ${saveButton.getTemplate()}
                        ${exitEditButton.getTemplate()}
                    </div>
                </div>
            </div>
        </div>`;
    }

    reInit (initClass) {
        this.makeModalBody();
        $('#' + this.modalBodyId).empty().append(this.modalBody);
        initClass.addListeners(this.getListeners());
        initClass.initListeners();
        initClass.mergeAdditionlClassesJQ(this.getAdditionlClassesJQ());
        initClass.initAdditionlClassesJQ();
    }

    exitEditHandle (initClass, props, event) {
        this.validationModel = {};
        this.reInit(initClass);
        $('#' + this.id).modal('toggle');
        initClass.cancelEditingModal();
    }

    saveModelHandle (initClass, props, event) {
        var jqId = '#' + this.id;
        mApp.block(jqId);
        if (this.modelId === 'new') {
            initClass.validateEditState(this.modelId, initClass.getNewEditStateModel());
        } else {
            initClass.validateEditState(this.modelId, initClass.getMergedEditStateModel(this.modelId));
        }
        if (initClass.validation.hasOwnProperty(this.modelId)) {
            this.validationModel = initClass.getValidatedObject(this.modelId);
            this.reInit(initClass);
        } else {
            $(jqId).modal('toggle');
            initClass.saveModel(this.modelId);
        }
        mApp.unblock(jqId);
    }

    addAdditionlClassesJQ (modelId, classVar) {
        AdditionlClassesJQ.add(this.additionlClassesJQ, modelId ,classVar);
        this.addListeners(classVar.getListeners());
    }

    getAdditionlClassesJQ () {
        return this.additionlClassesJQ;
    }
}
export default BaseModalEdit