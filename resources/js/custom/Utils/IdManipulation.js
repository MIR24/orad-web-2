const IdManipulation = {
    getPreparedId (name, id) {
        return `${name}-${id}`.replace(/[^a-zA-Zа-яА-ЯёЁ0-9-]+/g, "_");
    },

    getIdFromString (string) {
        return string.split('-').pop();
    }
}
export default IdManipulation