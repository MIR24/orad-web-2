import ModalsConfig from "../Config/ModalsConfig.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";
import SaveButton from "../Components/SaveButton.js";
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
    }

    makeTemplate () {}

    getBaseTemplate (bodyContent) {
        var exitEditButton = new ModalExitEditButton(this.id),
            exitEditButtonTop = new ModalExitEditButton(this.id, 'modal-exit-edit-top'),
            saveButton = new SaveButton(this.modelId);

        exitEditButton.init();
        exitEditButtonTop.init();
        saveButton.init();

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
                    <div class="modal-body">
                        ${bodyContent}
                    </div>
                    <div class="modal-footer">
                        ${saveButton.getTemplate()}
                        ${exitEditButton.getTemplate()}
                    </div>
                </div>
            </div>
        </div>`;
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
        this.makeTemplate();
        this.setOpenButton();
    }
}
export default BaseModal