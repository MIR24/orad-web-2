class Listeners {
    static set (classVar, type, listenerObj) {
        classVar.listeners[type] = Object.assign(classVar.listeners[type], listenerObj);
    }

    static add (classVar, listenerObj) {
        for (var type in listenerObj) {
            if (classVar.listeners.hasOwnProperty(type)) {
                classVar.listeners[type] = Object.assign(classVar.listeners[type], listenerObj[type]);
            } else {
                classVar.listeners[type] = listenerObj[type];
            }
        }
    }

    static init (classVar) {
        for (var type in classVar.listeners) {
            for (var key in classVar.listeners[type]) {
                if (classVar.listeners[type][key].addInitClass) {
                    $('#' + key).bind(type, classVar.listeners[type][key].function.bind(classVar.listeners[type][key].class, classVar));
                } else {
                    $('#' + key).bind(type, classVar.listeners[type][key].function.bind(classVar.listeners[type][key].class));
                }
                delete classVar.listeners[type][key];
            }
        }
    }
}