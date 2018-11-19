const TabsConfig = {
    "Tops": {
        "api": {
            "base": "/api/tops",
            "update": "/api/tops/multi",
            "delete": "/api/tops/",
        },
        "textMaxCharsPerLine": 70,
    },
    "Newsbar": {
        "api": {
            "base": "/api/newsbars",
            "update": "/api/newsbars/multi",
        },
        "textMaxCharsPerLine": 70,
    },
    "Expedited": {
        "api": {
            "base": "/api/hotnews",
            "update": "/api/hotnews/multi",
            "delete": "/api/hotnews/",
        },
        "textMaxCharsPerLine": 70,
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
            "name": "test name",
            "header": "test header",
            "subheader": "test subheader",
            "age": 0,
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