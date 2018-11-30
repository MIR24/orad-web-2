import BaseModalEdit from "../BaseClasses/BaseModalEdit.js";
import Input from "../Components/Input.js";
import Select2Custom from "../ExternalComponents/Select2Custom.js";
import DropZoneCustom from "../ExternalComponents/DropZoneCustom.js";

class PromoEditModal extends BaseModalEdit {
    constructor (id, model, type, additions) {
        super(id, type + '-promo', model, additions);
    }

    getModalBody () {
        if (jQuery.isEmptyObject(this.validationModel)) {
            var mirId = new Input(this.modelId, 'mir_id', this.model.mir_id, false, 'ID МИР'),
                mirHdId = new Input(this.modelId, 'mirhd_id', this.model.mirhd_id, false, 'ID МИРHD'),
                category = new Select2Custom (this.modelId, 'category_id', this.additions.category, this.model.category_id, false, this.constructor.name),
                name = new Input(this.modelId, 'name', this.model.name, false, 'Название'),
                title = new Input(this.modelId, 'header', this.model.header, false, 'Заголовок'),
                underTitle = new Input(this.modelId, 'subheader', this.model.subheader, false, 'Подзаголовок'),
                ageRestriction = new Input(this.modelId, 'age', this.model.age, false, '0', 'number'),
                mode = new Select2Custom (this.modelId, 'mode', this.additions.mode, this.model.mode, false, this.constructor.name),
                imageDrop = new DropZoneCustom(this.modelId, 'img', false, this.constructor.name, false),
                error = {};
        } else {
            var mirId = new Input(this.modelId, 'mir_id', this.validationModel.errorModel.mir_id, false, 'ID МИР'),
                mirHdId = new Input(this.modelId, 'mirhd_id', this.validationModel.errorModel.mirhd_id, false, 'ID МИРHD'),
                category = new Select2Custom (this.modelId, 'category_id', this.additions.category, this.validationModel.category_id, false, this.constructor.name),
                name = new Input(this.modelId, 'name', this.validationModel.errorModel.name, false, 'Название'),
                title = new Input(this.modelId, 'header', this.validationModel.errorModel.header, false, 'Заголовок'),
                underTitle = new Input(this.modelId, 'subheader', this.validationModel.errorModel.subheader, false, 'Подзаголовок'),
                ageRestriction = new Input(this.modelId, 'age', this.validationModel.errorModel.age, false, '0', 'number'),
                mode = new Select2Custom (this.modelId, 'mode', this.additions.mode, this.validationModel.mode, false, this.constructor.name),
                imageDrop = new DropZoneCustom(this.modelId, 'img', false, this.constructor.name, false),
                error = this.validationModel.errorValidation;
        }

        mirId.init();
        mirHdId.init();
        category.init();
        name.init();
        title.init();
        underTitle.init();
        ageRestriction.init();
        mode.init();
        imageDrop.init();

        this.addListeners(mirId.getListeners());
        this.addListeners(mirHdId.getListeners());
        this.addListeners(category.getListeners());
        this.addListeners(name.getListeners());
        this.addListeners(title.getListeners());
        this.addListeners(underTitle.getListeners());
        this.addListeners(ageRestriction.getListeners());
        this.addListeners(mode.getListeners());

        this.addAdditionlClassesJQ(this.modelId, category);
        this.addAdditionlClassesJQ(this.modelId, mode);
        this.addAdditionlClassesJQ(this.modelId, imageDrop);

        return `${this.getRow('Файл промо', imageDrop.getTemplate(), error.img)}
            ${this.getRow('ID МИР', mirId.getTemplate(), error.mir_id)}
            ${this.getRow('ID МИРHD', mirHdId.getTemplate(), error.mirhd_id)}
            ${this.getRow('Категория', category.getTemplate(), error.category)}
            ${this.getRow('Название', name.getTemplate(), error.name)}
            ${this.getRow('Заголовок', title.getTemplate(), error.header)}
            ${this.getRow('Подзаголовок', underTitle.getTemplate(), error.subheader)}
            ${this.getRow('Ограничение по возрасту', `
                <div class="input-group">
                    ${ageRestriction.getTemplate()}
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon1">+</span>
                    </div>
                </div>`,
            error.age)}
            ${this.getRow('Режим', mode.getTemplate(), error.mode)}
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
export default PromoEditModal