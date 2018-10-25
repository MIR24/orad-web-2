const IdManipulation = {
    getPreparedId (name, id) {
        return `${name}-${id}`;
    },

    getIdFromString (string) {
        return string.split('-').pop();
    }
}
export default IdManipulation