import BaseModal from "../BaseClasses/BaseModal.js";

class PromoCreateModal extends BaseModal {
    constructor (id) {
        super(id, 'create-promo');
    }
    
    makeTemplate () {
        this.template = this.getBaseTemplate();
    }
}
export default PromoCreateModal