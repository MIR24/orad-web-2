import ModalsConfig from "../Config/ModalsConfig.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";
import ModalSaveEditButton from "../Components/ModalSaveEditButton.js";
import ModalEnterEditButton from "../Components/ModalEnterEditButton.js";
import ModalExitEditButton from "../Components/ModalExitEditButton.js";

class BaseModal {
    constructor (id, type, model) {
        this.modelId = id; 
        this.id = IdManipulation.getPreparedId('modal-' + type, id);
        this.type = type;
        this.config = ModalsConfig[type];
        this.model = model;
        this.listeners = {};
        this.openButton = '';
        this.modalBodyId = IdManipulation.getPreparedId(this.id, 'body');
    }

    makeModalBody () {
        this.modalBody = this.getModalBody();
    }

    makeTemplate () {
        this.template = this.getBaseTemplate();
    }

    getBaseTemplate () {
        var exitEditButton = new ModalExitEditButton(this.id),
            exitEditButtonTop = new ModalExitEditButton(this.id, 'modal-exit-edit-top'),
            saveButton = new ModalSaveEditButton(this.modelId);

        exitEditButton.init();
        exitEditButtonTop.init();
        saveButton.init();

        exitEditButton.setNewHandle(this, this.exitEditHandle);
        exitEditButtonTop.setNewHandle(this, this.exitEditHandle);

        this.addListeners(exitEditButton.getListeners());
        this.addListeners(exitEditButtonTop.getListeners());
        this.addListeners(saveButton.getListeners());

        return `<div class="modal fade" id="${this.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
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

    exitEditHandle (initClass, props, event) {console.log(1);
        initClass.cancelEditing(props.childClass.modelId);
    }

    setOpenButton () {
        var button = new ModalEnterEditButton(this.id, this.config.enterEditBtn);
        button.init();
        this.addListeners(button.getListeners());
        this.openButton =  button.getTemplate();
    }
    
    getOpenButton () {
        return this.openButton;
    }

    addListeners (listenerObj) {
        Listeners.add(this, listenerObj);
    }

    getListeners () {
        return this.listeners;
    }

    getTemplate () {
        return this.template;
    }

    init () {
        this.makeModalBody()
        this.makeTemplate();
        this.setOpenButton();
    }
}
export default BaseModal