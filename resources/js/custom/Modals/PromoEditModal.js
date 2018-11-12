import BaseModal from "../BaseClasses/BaseModal.js";
import Input from "../Components/Input.js";

class PromoEditModal extends BaseModal {
    constructor (id, model, type) {
        super(id, type + '-promo', model);
    }

    getModalBody () {
        var mirId = new Input(this.modelId, 'mir_id', this.model.mir_id, false, 'ID МИР'),
            mirHdId = new Input(this.modelId, 'mirhd_id', this.model.mirhd_id, false, 'ID МИРHD'),
            category = 'Категория',
            name = new Input(this.modelId, 'name', this.model.name, false, 'Название'),
            title = new Input(this.modelId, 'header', this.model.header, false, 'Заголовок'),
            underTitle = new Input(this.modelId, 'subheader', this.model.subheader, false, 'Подзаголовок'),
            ageRestriction = new Input(this.modelId, 'age', this.model.age, false, '0', 'number'),
            mode = 'Режим';

        mirId.init();
        mirHdId.init();
        name.init();
        title.init();
        underTitle.init();
        ageRestriction.init();

        this.addListeners(mirId.getListeners());
        this.addListeners(mirHdId.getListeners());
        this.addListeners(name.getListeners());
        this.addListeners(title.getListeners());
        this.addListeners(underTitle.getListeners());
        this.addListeners(ageRestriction.getListeners());

        return `
            <div class="pb-4">
                <lable class="float-left">ID МИР</lable>
                ${mirId.getTemplate()}
            </div>
            <div class="pb-4">
                <lable class="float-left">ID МИРHD</lable>
                ${mirHdId.getTemplate()}
            </div>
            <div class="pb-4">
                <lable class="float-left">Название</lable>
                ${name.getTemplate()}
            </div>
            <div class="pb-4">
                <lable class="float-left">Заголовок</lable>
                ${title.getTemplate()}
            </div>
            <div class="pb-4">
                <lable class="float-left">Подзаголовок</lable>
                ${underTitle.getTemplate()}
            </div>
            <div class="pb-4">
                <lable class="float-left">Ограничение по возрасту</lable>
                <div class="input-group">
					<div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">+</span>
                    </div>
					${ageRestriction.getTemplate()}
				</div>
            </div>
        `;
    }
}
export default PromoEditModal