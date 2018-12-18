const Storage = {
    storage: {},

    put (index, content) {
        if (this.storage.hasOwnProperty(index)) {
            Object.assign(this.storage[index], content);
        } else {
            Object.assign(this.storage, {[index]: content});
        }
    },

    get (index) {
        return this.storage[index];
    },

    getIfExits (index, type) {
        if (this.storage.hasOwnProperty(index) && 
            this.storage[index].hasOwnProperty(type)) {
            return this.storage[index][type];
        }
        return false;
    },

    clear () {
        this.storage = {};
    }
}
export default Storage