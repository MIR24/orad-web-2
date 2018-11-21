import BaseModal from "../BaseClasses/BaseModal.js";
import ModalSaveEditButton from "../Components/ModalSaveEditButton.js";
import ModalExitEditButton from "../Components/ModalExitEditButton.js";
import ModalEnterEditButton from "../Components/ModalEnterEditButton.js";

class BaseModalEdit extends BaseModal {
    constructor (id, type, model) {
        super(id, type, model);
        this.validationModel = {};
    }

    getBaseTemplate () {
        var openButton = new ModalEnterEditButton(this.id, this.config.enterEditBtn),
            exitEditButton = new ModalExitEditButton(this.id),
            exitEditButtonTop = new ModalExitEditButton(this.id, 'modal-exit-edit-top'),
            saveButton = new ModalSaveEditButton(this.modelId);

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

    exitEditHandle (initClass, props, event) {
        this.makeModalBody();
        $('#' + this.modalBodyId).empty().append(this.modalBody);
        $('#' + this.id).modal('toggle');
        initClass.addListeners(this.getListeners());
        initClass.initListeners();
        initClass.cancelEditingModal();
    }

    saveModelHandle (initClass, props, event) {
        $('#' + this.modalContentId).append(this.config.loader.template);
        if (this.modelId === 'new') {
            initClass.validateEditState(this.modelId, initClass.getNewEditStateModel());
        } else {
            initClass.validateEditState(this.modelId, initClass.getMergedEditStateModel(this.modelId));
        }
        this.validationModel = initClass.getValidatedObject(this.modelId);
        if (this.validationModel !== false) {
            this.makeModalBody();
            $('#' + this.modalBodyId).empty().append(this.modalBody);
            initClass.addListeners(this.getListeners());
            initClass.initListeners();
            this.validationModel = {};
            $(this.config.loader.jqClassName).remove();
        } else {
            $('#' + this.id).modal('toggle');
            initClass.saveModel(this.modelId);
        }
    }
}
export default BaseModalEdit