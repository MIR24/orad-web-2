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
            var mirId = new Input(this.modelId, 'mir_id', this.model.mir_id, this.additions.premissions.mir_id, 'ID МИР'),
                mirHdId = new Input(this.modelId, 'mirhd_id', this.model.mirhd_id, this.additions.premissions.mirhd_id, 'ID МИРHD'),
                category = new Select2Custom (this.modelId, 'category_id', this.additions.category, this.model.category_id, this.additions.premissions.category_id, this.constructor.name),
                name = new Input(this.modelId, 'name', this.model.name, this.additions.premissions.name, 'Название'),
                title = new Input(this.modelId, 'header', this.model.header, this.additions.premissions.header, 'Заголовок'),
                underTitle = new Input(this.modelId, 'subheader', this.model.subheader, this.additions.premissions.subheader, 'Подзаголовок'),
                ageRestriction = new Input(this.modelId, 'age', this.model.age, this.additions.premissions.age, '0', 'number'),
                mode = new Select2Custom (this.modelId, 'mode', this.additions.mode, this.model.mode, this.additions.premissions.mode, this.constructor.name),
                imageDrop = new DropZoneCustom(this.modelId, 'img_path', this.model.img_path, this.constructor.name, this.additions.premissions.img_path),
                error = {};
        } else {
            var mirId = new Input(this.modelId, 'mir_id', this.validationModel.errorModel.mir_id, this.additions.premissions.mir_id, 'ID МИР'),
                mirHdId = new Input(this.modelId, 'mirhd_id', this.validationModel.errorModel.mirhd_id, this.additions.premissions.mirhd_id, 'ID МИРHD'),
                category = new Select2Custom (this.modelId, 'category_id', this.additions.category, this.validationModel.category_id, this.additions.premissions.category, this.constructor.name),
                name = new Input(this.modelId, 'name', this.validationModel.errorModel.name, this.additions.premissions.name, 'Название'),
                title = new Input(this.modelId, 'header', this.validationModel.errorModel.header, this.additions.premissions.header, 'Заголовок'),
                underTitle = new Input(this.modelId, 'subheader', this.validationModel.errorModel.subheader, this.additions.premissions.subheader, 'Подзаголовок'),
                ageRestriction = new Input(this.modelId, 'age', this.validationModel.errorModel.age, this.additions.premissions.age, '0', 'number'),
                mode = new Select2Custom (this.modelId, 'mode', this.additions.mode, this.validationModel.mode, this.additions.premissions.mode, this.constructor.name),
                imageDrop = new DropZoneCustom(this.modelId, 'img_path', this.validationModel.img_path, this.constructor.name, this.additions.premissions.img_path),
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

        return `${this.getRow('Файл промо', imageDrop.getTemplate(), error.img_path)}
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