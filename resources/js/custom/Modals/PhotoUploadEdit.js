import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import Input from "../Components/Input.js";
import DropZoneCustom from "../ExternalComponents/DropZoneCustom.js";

class PhotoUploadEdit extends BaseModalEdit {
    constructor (id, model, type, additions) {
        super(id, type + '-promo', model, additions);
    }

    getModalBody () {
        if (jQuery.isEmptyObject(this.validationModel)) {
            var external_id = new Input(this.modelId, 'external_id', this.model.external_id, this.additions.premissions.external_id, 'ID'),
                name = new Input(this.modelId, 'name', this.model.name, this.additions.premissions.name, 'Название'),
                imageDrop = new DropZoneCustom(this.modelId, 'path', false, this.constructor.name, this.additions.premissions.path),
                error = {};
        } else {
            var external_id = new Input(this.modelId, 'external_id', this.validationModel.errorModel.external_id, this.additions.premissions.external_id, 'ID'),
                name = new Input(this.modelId, 'name', this.validationModel.errorModel.name, this.additions.premissions.name, 'Название'),
                imageDrop = new DropZoneCustom(this.modelId, 'path', false, this.constructor.name, this.additions.premissions.path),
                error = this.validationModel.errorValidation;
        }

        external_id.init();
        name.init();
        imageDrop.init();

        this.addListeners(external_id.getListeners());
        this.addListeners(name.getListeners());
        this.addAdditionlClassesJQ(this.modelId, imageDrop);

        return `${this.getRow('Файл', imageDrop.getTemplate(), error.path)}
            ${this.getRow('ID МИР', external_id.getTemplate(), error.external_id)}
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