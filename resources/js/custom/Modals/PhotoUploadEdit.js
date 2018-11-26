import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import Input from "../Components/Input.js";

class PhotoUploadEdit extends BaseModalEdit {
    constructor (id, model, type, additions) {
        super(id, type + '-promo', model, additions);
    }

    getModalBody () {
        if (jQuery.isEmptyObject(this.validationModel)) {
            var customId = new Input(this.modelId, 'customId', this.model.customId, false, 'ID'),
                name = new Input(this.modelId, 'name', this.model.name, false, 'Название'),
                error = {};
        } else {
            var customId = new Input(this.modelId, 'customId', this.validationModel.errorModel.customId, false, 'ID'),
                name = new Input(this.modelId, 'name', this.validationModel.errorModel.name, false, 'Название'),
                error = this.validationModel.errorValidation;
        }

        customId.init();
        name.init();

        this.addListeners(customId.getListeners());
        this.addListeners(name.getListeners());

        return `${this.getRow('ID МИР', customId.getTemplate(), error.customId)}
            ${this.getRow('Название', name.getTemplate(), error.name)}
        `;
    }

    getRow (label, elementTemplate, errorMessage) {
        if (errorMessage) {
            return `<div class="form-group m-form__group has-danger text-left">
                <label>${label}</label>
                ${elementTemplate}
                <label>${errorMessage}</label>
            </div>`;
        } else {
            return `<div class="form-group m-form__group text-left">
                <label>${label}</label>
                ${elementTemplate}
            </div>`;
        }
    }
}
export default PhotoUploadEdit