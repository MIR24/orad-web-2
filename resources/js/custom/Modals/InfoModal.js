import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import SimpleButton from "../Components/SimpleButton.js";

class InfoModal extends BaseModalEdit {
    constructor (id, type, message) {
        super(id, 'info-' + type);
        this.message = message
    }

    getBaseTemplate () {
        var closeButton = new SimpleButton(this.id, this.config.closeButton, true);

        closeButton.init();
        closeButton.setNewHandle(this, this.__proto__.handle);
        this.addListeners(closeButton.getListeners());

        return `<div class="modal fade" id="${this.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div id=${this.modalBodyId} class="modal-body">
                        ${this.message}
                    </div>
                    <div class="modal-footer">
                        ${closeButton.getTemplate()}
                    </div>
                </div>
            </div>
        </div>`;
    }

    handle (initClass, props, event) {
        this.toggleModal();
    }

    getUtilityBlockInfo () {
        return {
            [this.type]: {
                'open': this.__proto__.toggleModal.bind(this),
            }
        };
    }
}
export default InfoModal