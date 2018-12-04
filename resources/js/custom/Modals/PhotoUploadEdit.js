import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import Input from "../Components/Input.js";
import DropZoneCustom from "../ExternalComponents/DropZoneCustom.js";

class PhotoUploadEdit extends BaseModalEdit {
    constructor (id, model, type, additions) {
        super(id, type + '-promo', model, additions);
    }

    getModalBody () {
        if (jQuery.isEmptyObject(this.validationModel)) {
            var customId = new Input(this.modelId, 'customId', this.model.customId, this.additions.premissions.customId, 'ID'),
                name = new Input(this.modelId, 'name', this.model.name, this.additions.premissions.name, 'Название'),
                imageDrop = new DropZoneCustom(this.modelId, 'img', false, this.constructor.name, false),
                error = {};
        } else {
            var customId = new Input(this.modelId, 'customId', this.validationModel.errorModel.customId, this.additions.premissions.customId, 'ID'),
                name = new Input(this.modelId, 'name', this.validationModel.errorModel.name, this.additions.premissions.name, 'Название'),
                imageDrop = new DropZoneCustom(this.modelId, 'img', false, this.constructor.name, false),
                error = this.validationModel.errorValidation;
        }

        customId.init();
        name.init();
        imageDrop.init();

        this.addListeners(customId.getListeners());
        this.addListeners(name.getListeners());
        this.addAdditionlClassesJQ(this.modelId, imageDrop);

        return `${this.getRow('Файл', imageDrop.getTemplate(), error.img)}
            ${this.getRow('ID МИР', customId.getTemplate(), error.customId)}
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