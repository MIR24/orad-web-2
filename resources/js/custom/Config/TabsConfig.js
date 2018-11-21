import { configFromDB, validationMessages } from "../Config/Constants"

const TabsConfig = {
    "Tops": {
        "api": {
            "base": "/api/tops",
            "update": "/api/tops/multi",
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
    },
    "Newsbar": {
        "api": {
            "base": "/api/newsbars",
            "update": "/api/newsbars/multi",
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
    },
    "Expedited": {
        "api": {
            "base": "/api/hotnews",
            "update": "/api/hotnews/multi",
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
    },
    "CurrencyValues": {
        "api": {
            "base": "/api/currencyrates",
            "update": "/api/currencyrates/multi",
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
    },
    "WeatherLive": {
        "api": {
            "base": "/api/weatherforecasts",
            "update": "/api/weatherforecasts/multi",
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
    },
    "TimeShift": {
        "api": {
            "base": "/api/citytimeshifts",
            "update": "/api/citytimeshifts/multi",
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
    },
    "Countdown": {
        "api": {
            "base": "/api/eventcountdowns",
            "update": "/api/eventcountdowns/multi",
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
    },
    "Promo": {
        "api": {
            "base": "/api/promos",
            "update": "/api/promos/multi",
            "delete": "/api/promos/",
        },
        "defaultEditState": {
            "mir_id": 0,
            "mirhd_id": 0,
            "name": "",
            "header": "",
            "subheader": "",
            "age": 0,
        },
        "validation": {
            "notNull": {
                "fieldNames": [
                    "mir_id",
                    "mirhd_id",
                    "name",
                    "header",
                    "subheader",
                    "age"
                ],
                'errorMsg': validationMessages.requiredField,
            },
        },
        "pagination": {
            "params": {
                "offset": 0,
                "limit": 51,
            },
            "hasMore": true,
        },
    },
}
export default TabsConfig