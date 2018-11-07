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
            "update": "/api/tops/multi",
            "delete": "/api/tops/",
        },
        "textMaxCharsPerLine": 70,
    },
    "CurrencyValues": {
        "api": {
            "base": "/test/currency",
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
            "base": "/test/timeshift",
        },
    },
    "Countdown": {
        "api": {
            "base": "/test/countdown",
        },
    },
    "Promo": {
        "api": {
            "base": "/test/promo",
        },
    },
}
export default TabsConfig