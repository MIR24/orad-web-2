const AdditionlClassesJQ = {
    merge (initObject, newObject) {
        initObject = Object.assign(initObject, newObject);
    },

    add (initObject, modelId, classVar) {
        var options = classVar.getOptions();
        if (initObject.hasOwnProperty(modelId)) {
            initObject[modelId] = Object.assign(initObject[modelId], {
                [options.selectString]: options
            });
        } else {
            initObject[modelId] = {
                [options.selectString]: options
            };
        }
    },

    init (initObject) {
        for (var modelId in initObject) {
            for (var elementId in initObject[modelId]) {
                $(initObject[modelId][elementId].selectString)[initObject[modelId][elementId].function](initObject[modelId][elementId].options);
            }
        }
    }
}
export default AdditionlClassesJQ