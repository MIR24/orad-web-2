import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import SimpleButton from "../Components/SimpleButton.js";

class ConformationModal extends BaseModalEdit {
    constructor (id, type) {
        super(id, 'confirmation-' + type);
    }

    getBaseTemplate () {
        var okButton = new SimpleButton(this.id, this.config.okButton, true),
            noButton = new SimpleButton(this.id, this.config.noButton, false);

        okButton.init();
        noButton.init();

        okButton.setNewHandle(this, this.__proto__.handle);
        noButton.setNewHandle(this, this.__proto__.handle);

        this.addListeners(okButton.getListeners());
        this.addListeners(noButton.getListeners());

        return `<div class="modal fade" id="${this.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div id=${this.modalBodyId} class="modal-body">
                        ${this.config.message}
                    </div>
                    <div class="modal-footer">
                        ${okButton.getTemplate()}
                        ${noButton.getTemplate()}
                    </div>
                </div>
            </div>
        </div>`;
    }

    toggleModal () {
        $('#' + this.id).modal('toggle');
    }

    handle (initClass, props, event) {
        this.toggleModal();
        if (props.childClass.valueName == true) {
            initClass.utilityBlocksInfo[this.type].continue();
        }
    }

    getUtilityBlockInfo () {
        return {
            [this.type]: {
                'open': this.__proto__.toggleModal.bind(this),
            }
        };
    }
}
export default ConformationModal