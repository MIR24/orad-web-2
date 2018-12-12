import {
    settingsDBUrlBase,
    validationMessages,
    weatherTypesUrlBase,
    orbitsUrlBase,
    currentActive,
} from "../Config/Constants"
import SettingsDB from "../Utils/SettingsDB";

const TabsConfig = {
    init () {
        this.values = {
            "default": {
                "doNotMergeAfterOneSave": [
                    "Promo",
                    "PhotoUpload",
                ],
            },
            "Tops": {
                "backendPremissionModelName": "tops",
                "api": {
                    "base": "/api/tops",
                    "updateCreate": "/api/tops-collections",
                    "delete": "/api/tops/",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=Tops',
                },
                "textMaxCharsPerLine": SettingsDB.values.SINGLE_TOP_LENGTH,
                "defaultEditState": {
                    "text": null,
                    "strings": null,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "text",
                            "strings",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "strings": {
                            "regex": `^.{${(SettingsDB.values.SINGLE_TOP_LENGTH + 1)},}$`,
                            "flags": "gm",
                            "errorMsg": validationMessages.toManyChars,
                        },
                    },
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                    "confirmation-edit-next-model",
                ],
            },
            "Newsbar": {
                "backendPremissionModelName": "newsbars",
                "api": {
                    "base": "/api/newsbars",
                    "updateCreate": "/api/newsbars-collections",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=Newsbar',
                },
                "textMaxCharsPerLineHOT": SettingsDB.values.NB_TOP_LENGTH,
                "textMaxCharsPerLineBEG": SettingsDB.values.NB_BEG_LENGTH,
                "defaultEditState": {
                    "text": null,
                    "strings": null,
                },
                "validationCheckById": true,
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "0strings",
                            "1strings",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "0strings": {
                            "regex": `^.{${(SettingsDB.values.NB_TOP_LENGTH + 1)},}$`,
                            "flags": "gm",
                            "errorMsg": validationMessages.toManyChars,
                        },
                        "1strings": {
                            "regex": `^.{${(SettingsDB.values.NB_BEG_LENGTH + 1)},}$`,
                            "flags": "gm",
                            "errorMsg": validationMessages.toManyChars,
                        },
                    },
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                    "confirmation-edit-next-model",
                ],
            },
            "Expedited": {
                "backendPremissionModelName": "hotnews",
                "api": {
                    "base": "/api/hotnews",
                    "updateCreate": "/api/hotnews-collections",
                    "delete": "/api/hotnews/",
                },
                "textMaxCharsPerLine": SettingsDB.values.SINGLE_HOT_LENGTH,
                "defaultEditState": {
                    "text": null,
                    "strings": null,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "text",
                            "strings",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "strings": {
                            "regex": `^.{${(SettingsDB.values.SINGLE_HOT_LENGTH + 1)},}$`,
                            "flags": "gm",
                            "errorMsg": validationMessages.toManyChars,
                        },
                    },
                },
                "getAdditions": {
                    "orbits": orbitsUrlBase,
                    "help": '/api/tabs?q=Expedited',
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                    "confirmation-edit-next-model",
                ],
            },
            "CurrencyValues": {
                "backendPremissionModelName": "currencyrates",
                "api": {
                    "base": "/api/currencyrates",
                    "updateCreate": "/api/currencyrates-collections",
                    "delete": "/api/currencyrates/",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=CurrencyValues',
                },
                "defaultEditState": {
                    "val1": null,
                    "val2": null,
                    "dir": 0,
                    "value": 0,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "val1",
                            "val2",
                            "value",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "val1": {
                            "regex": '^.{6,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 5,
                        },
                        "val2": {
                            "regex": `^.{6,}$`,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 5,
                        },
                    },
                    "regexSuccess": {
                        "value": {
                            "regex": /^[\+\-]?\d{0,4}$|^[\+\-]?\d{0,4}\.[\d]{0,4}?$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 4,
                        },
                    },
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "WeatherLive": {
                "backendPremissionModelName": "weatherforecasts",
                "api": {
                    "base": "/api/weatherforecasts",
                    "updateCreate": "/api/weatherforecasts-collections",
                    "delete": "/api/weatherforecasts/",
                },
                "defaultEditState": {
                    "status": "inactive",
                    "city": null,
                    "morning": null,
                    "evening": null,
                    "weather_type_id": 0,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "status",
                            "city",
                            "morning",
                            "evening",
                            "weather_type_id",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "city": {
                            "regex": '^.{71,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 70,
                        },
                    },
                    "regexSuccess": {
                        "morning": {
                            "regex": /^[\+|\-]?\d{0,3}$|^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 3,
                        },
                        "evening": {
                            "regex": /^[\+|\-]?\d{0,3}$|^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 3,
                        },
                    },
                },
                "switchValue": {
                    "status": {
                        "true": "active",
                        "false": "inactive"
                    }
                },
                "getAdditions": {
                    "weatherTypes": weatherTypesUrlBase,
                    "help": '/api/tabs?q=WeatherLive',
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "WeatherLiveLiner": {
                "backendPremissionModelName": "weatherforecastsliners",
                "api": {
                    "base": "/api/weatherforecastsliners",
                    "updateCreate": "/api/weatherforecastsliners-collections",
                    "delete": "/api/weatherforecastsliners/",
                },
                "defaultEditState": {
                    "status": "inactive",
                    "city": null,
                    "morning": null,
                    "now": null,
                    "evening": null,
                    "weather_type_id": 0,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "status",
                            "city",
                            "now",
                            "morning",
                            "evening",
                            "weather_type_id",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "city": {
                            "regex": '^.{71,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 70,
                        },
                    },
                    "regexSuccess": {
                        "now": {
                            "regex": /^[\+|\-]?\d{0,3}$|^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 3,
                        },
                        "morning": {
                            "regex": /^[\+|\-]?\d{0,3}$|^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 3,
                        },
                        "evening": {
                            "regex": /^[\+|\-]?\d{0,3}$|^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 3,
                        },
                    },
                },
                "switchValue": {
                    "status": {
                        "true": "active",
                        "false": "inactive"
                    }
                },
                "getAdditions": {
                    "weatherTypes": weatherTypesUrlBase,
                    "help": '/api/tabs?q=WeatherLiveLiner',
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "TimeShift": {
                "backendPremissionModelName": "citytimeshifts",
                "api": {
                    "base": "/api/citytimeshifts",
                    "updateCreate": "/api/citytimeshifts-collections",
                    "delete": "/api/citytimeshifts/",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=TimeShift',
                },
                "defaultEditState": {
                    "city": null,
                    "timeshift": null,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "city",
                            "timeshift",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "city": {
                            "regex": '^.{71,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 70,
                        },
                    },
                    "regexSuccess": {
                        "timeshift": {
                            "regex": /^\d{0,10}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 10,
                        },
                    },
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "Countdown": {
                "backendPremissionModelName": "eventcountdowns",
                "api": {
                    "base": "/api/eventcountdowns",
                    "updateCreate": "/api/eventcountdowns-collections",
                    "delete": "/api/eventcountdowns/",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=Countdown',
                },
                "defaultEditState": {
                    "title": null,
                    "description": "test",
                    "happen_at": null,
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "title",
                            "happen_at",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "happen_at": {
                            "regex": `^(0000-01-01|.+Invalid).+$`,
                            "flags": "g",
                            "errorMsg": validationMessages.dataTimeAgain,
                        },
                        "title": {
                            "regex": '^.{201,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 200,
                        },
                    },
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "Promo": {
                "backendPremissionModelName": "promos",
                "api": {
                    "base": "/api/promos",
                    "updateCreate": "/api/promos-collections",
                    "delete": "/api/promos/",
                },
                "getAdditions": {
                    "category": "/api/promocategories",
                    "help": '/api/tabs?q=Promo',
                },
                "defaultEditState": {
                    "mir_id": null,
                    "mirhd_id": null,
                    "category_id": 1,
                    "name": null,
                    "header": null,
                    "subheader": null,
                    "age": null,
                    "mode": 0,
                },
                'premissions': {
                    'update': [
                        "mir_id",
                        "mirhd_id",
                        "category_id",
                        "name",
                        "header",
                        "subheader",
                        "age",
                        "mode",
                        "img",
                    ],
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "mir_id",
                            "mirhd_id",
                            "category_id",
                            "name",
                            "header",
                            "subheader",
                            "age",
                            "mode",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexSuccess": {
                        "mir_id": {
                            "regex": /^\d{0,10}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 10,
                        },
                        "mirhd_id": {
                            "regex": /^\d{0,10}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 10,
                        },
                        "age": {
                            "regex": /^\d{0,3}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 3,
                        },
                    },
                },
                "pagination": {
                    "params": {
                        "offset": 0,
                        "limit": 21,
                    },
                    "hasMore": true,
                },
                "configModel": {
                    "mode": {
                        0: {
                            'type': 0,
                        },
                        1: {
                            'type': 1,
                        },
                    }
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "PhotoUpload": {
                "backendPremissionModelName": "nowfurtherlaters",
                "api": {
                    "base": "/api/nowfurtherlaters",
                    "updateCreate": "/api/nowfurtherlaters-collections",
                    "delete": "/api/nowfurtherlaters/",
                },
                "getAdditions": {
                    "help": '/api/tabs?q=PhotoUpload',
                },
                "defaultEditState": {
                    "external_id": null,
                    "name": null,
                    "path": 'test',
                },
                'premissions': {
                    'update': [
                        "external_id",
                        "name",
                        "path",
                    ],
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "external_id",
                            "name",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexSuccess": {
                        "external_id": {
                            "regex": /^\d{0,10}$/,
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThanInt + 10,
                        },
                    },
                },
                "pagination": {
                    "params": {
                        "offset": 0,
                        "limit": 21,
                    },
                    "hasMore": true,
                },
                "extraBlocks": [
                    "info-show-help-model",
                    "confirmation-delete-model",
                ],
            },
            "ConfigurationControl": {
                "backendPremissionModelName": "settings",
                "api": {
                    "base": settingsDBUrlBase,
                    "updateCreate": "/api/settings-collections",
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "value",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexSuccess": {
                        "value": {
                            "regex": `^[0-9]+$`,
                            "flags": "g",
                            "errorMsg": validationMessages.onlyInteger,
                        },
                    },
                },
                "extraBlocks": [],
            },
            "HelpRedacting": {
                "backendPremissionModelName": "tabs",
                "api": {
                    "base": "/api/tabs",
                    "updateCreate": "/api/tabs-collections",
                },
                "extraBlocks": [
                    "confirmation-edit-next-model",
                ],
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "name",
                            "text",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                },
            },
            "WeatherTypes": {
                "backendPremissionModelName": "weathertypes",
                "api": {
                    "base": weatherTypesUrlBase,
                    "updateCreate": "/api/weathertypes-collections",
                    "delete": "/api/weathertypes/",
                },
                "defaultEditState": {
                    "name": null,
                    "icon": 'test',
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "type",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                },
                "extraBlocks": [
                    "confirmation-delete-model",
                ],
            },
            "Orbits": {
                "backendPremissionModelName": "orbits",
                "api": {
                    "base": orbitsUrlBase,
                    "updateCreate": "/api/orbits-collections",
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "name",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                    "regexFailed": {
                        "name": {
                            "regex": '^.{46,}$',
                            "flags": "g",
                            "errorMsg": validationMessages.noMoreThan + 45,
                        },
                    },
                },
                "extraBlocks": [],
            },
            "PromoCategories": {
                "backendPremissionModelName": "promocategories",
                "api": {
                    "base": "/api/promocategories",
                    "updateCreate": "/api/promocategories-collections",
                    "delete": "/api/promocategories/",
                },
                "validation": {
                    "notNull": {
                        "fieldNames": [
                            "text",
                        ],
                        'errorMsg': validationMessages.requiredField,
                    },
                },
                "extraBlocks": [
                    "confirmation-delete-model",
                ],
            },
        };

        if (currentActive.tab.currentTabClassVar) {
            currentActive.tab.currentTabClassVar.config = Object.assign({}, this.values[currentActive.tab.currentTabClassVar.constructor.name], this.values.default);
        } else {
            currentActive.tab.config = Object.assign({}, this.values[currentActive.tab.constructor.name], this.values.default);
        }
    },
    values: {}
}
export default TabsConfig