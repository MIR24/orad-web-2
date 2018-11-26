import { configFromDB, validationMessages } from "../Config/Constants"

const TabsConfig = {
    "Tops": {
        "api": {
            "base": "/api/tops",
            "updateCreate": "/api/tops-collections",
            "delete": "/api/tops/",
        },
        "textMaxCharsPerLine": configFromDB.topsMaxCharsPerLine,
        "defaultEditState": {
            "text": "",
            "strings": "",
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
                    "regex": `^.{${(configFromDB.topsMaxCharsPerLine + 1)},}$`,
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
        "api": {
            "base": "/api/newsbars",
            "updateCreate": "/api/newsbars-collections",
        },
        "textMaxCharsPerLine": configFromDB.newsbarMaxCharsPerLine,
        "defaultEditState": {
            "text": "",
            "strings": "",
        },
        "validation": {
            "notNull": {
                "fieldNames": [
                    "strings",
                ],
                'errorMsg': validationMessages.requiredField,
            },
            "regexFailed": {
                "strings": {
                    "regex": `^.{${(configFromDB.newsbarMaxCharsPerLine + 1)},}$`,
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
        "api": {
            "base": "/api/hotnews",
            "updateCreate": "/api/hotnews-collections",
            "delete": "/api/hotnews/",
        },
        "textMaxCharsPerLine": configFromDB.expeditedMaxCharsPerLine,
        "defaultEditState": {
            "text": "",
            "strings": "",
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
                    "regex": `^.{${(configFromDB.newsbarMaxCharsPerLine + 1)},}$`,
                    "flags": "gm",
                    "errorMsg": validationMessages.toManyChars,
                },
            },
        },
        "getAdditions": {
            "orbits": "/api/orbits",
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
            "confirmation-edit-next-model",
        ],
    },
    "CurrencyValues": {
        "api": {
            "base": "/api/currencyrates",
            "updateCreate": "/api/currencyrates-collections",
            "delete": "/api/currencyrates/",
        },
        "defaultEditState": {
            "val1": "",
            "val2": "",
            "dir": "stay",
            "value": 0,
        },
        "validation": {
            "notNull": {
                "fieldNames": [
                    "val1",
                    "val2",
                ],
                'errorMsg': validationMessages.requiredField,
            },
            "regexFailed": {
                "val1": {
                    "regex": '^.{6,}$',
                    "flags": "g",
                    "errorMsg": validationMessages.noMoreThan5,
                },
                "val2": {
                    "regex": `^.{6,}$`,
                    "flags": "g",
                    "errorMsg": validationMessages.noMoreThan5,
                },
            },
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "WeatherLive": {
        "api": {
            "base": "/api/weatherforecasts",
            "updateCreate": "/api/weatherforecasts-collections",
            "delete": "/api/weatherforecasts/",
        },
        "defaultEditState": {
            "status": "inactive",
            "city": "",
            "morning": 0,
            "now": 0,
            "evening": 0,
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
        },
        "switchValue": {
            "status": {
                "true": "active",
                "false": "inactive"
            }
        },
        "getAdditions": {
            "weatherTypes": "/api/weathertypes",
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "WeatherLiveLiner": {
        "api": {
            "base": "/api/weatherforecastsliner",
            "updateCreate": "/api/weatherforecastsliner-collections",
            "delete": "/api/weatherforecastsliner/",
        },
        "defaultEditState": {
            "status": "inactive",
            "city": "",
            "morning": 0,
            "now": 0,
            "evening": 0,
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
        },
        "switchValue": {
            "status": {
                "true": "active",
                "false": "inactive"
            }
        },
        "getAdditions": {
            "weatherTypes": "/api/weathertypes",
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "TimeShift": {
        "api": {
            "base": "/api/citytimeshifts",
            "updateCreate": "/api/citytimeshifts-collections",
            "delete": "/api/citytimeshifts/",
        },
        "defaultEditState": {
            "city": "",
            "timeshift": 0,
        },
        "validation": {
            "notNull": {
                "fieldNames": [
                    "city",
                    "timeshift",
                ],
                'errorMsg': validationMessages.requiredField,
            },
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "Countdown": {
        "api": {
            "base": "/api/eventcountdowns",
            "updateCreate": "/api/eventcountdowns-collections",
            "delete": "/api/eventcountdowns/",
        },
        "defaultEditState": {
            "title": "",
            "description": "test",
            "happen_at": "",
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
            },
        },
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "Promo": {
        "api": {
            "base": "/api/promos",
            "updateCreate": "/api/promos-collections",
            "delete": "/api/promos/",
        },
        "getAdditions": {
            "category": "/api/promocategories",
        },
        "defaultEditState": {
            "mir_id": 0,
            "mirhd_id": 0,
            "category_id": 0,
            "name": "",
            "header": "",
            "subheader": "",
            "age": 0,
            "mode": 0,
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
        "api": {
            "base": "/test/photoUpload",
            "updateCreate": "/api/photoUpload",
            "delete": "/api/photoUpload/",
        },
        "defaultEditState": {
            "customId": 0,
            "name": '',
            "img": '',
        },
        "validation": {
            "notNull": {
                "fieldNames": [
                    "customId",
                    "name",
                    "img",
                ],
                'errorMsg': validationMessages.requiredField,
            },
        },
        /*"pagination": {
            "params": {
                "offset": 0,
                "limit": 21,
            },
            "hasMore": true,
        },*/
        "extraBlocks": [
            "info-show-help-model",
            "confirmation-delete-model",
        ],
    },
    "ConfigurationControl": {
        "api": {
            "base": "/api/settings",
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
        "api": {
            "base": "/test/helpredacting",
            "updateCreate": "/test/helpredacting",
        },
        "extraBlocks": [],
    },
}
export default TabsConfig