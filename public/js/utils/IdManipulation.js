class IdManipulation {
    static getPreparedId (name, id) {
        return `${name}-${id}`;
    }

    static getIdFromString (string) {
        return string.split('-').pop();
    }
}