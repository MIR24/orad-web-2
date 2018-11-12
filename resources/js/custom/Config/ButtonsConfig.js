const ButtonsConfig = {
    "base": {
        "text": "",
        "cssClass": "",
        "additions": "",
    },
    "add-empty-block": {
        "text": "+ Добавить",
        "cssClass": "btn-primary mr-1",
    },
    "save-model": {
        "text": "Сохранить",
        "cssClass": "btn-success",
    },
    "save-model-CurrencyValues-new": {
        "text": "Сохранить",
        "cssClass": "btn-success ml-2",
    },
    "remove-model": {
        "text": "Удалить",
        "cssClass": "btn-danger",
    },
    "delete-button-CurrencyValues": {
        "text": "Удалить",
        "cssClass": "btn-danger ml-2",
    },
    "cancel-model-redacting": {
        "text": "Отменить",
        "cssClass": "btn-danger ml-2",
    },
    "enter-model-redacting": {
        "text": "Редактировать",
        "cssClass": "btn-primary mr-2",
    },
    "arrow-spinner": {
        "firstKey": 1,
        "options": {
            0: {
                "text": "-",
                "cssClass": "btn-dark",
                "newModelValue": "stay",
            },
            1: {
                "text": "↗",
                "cssClass": "btn-success",
                "newModelValue": "rise",
            },
            2: {
                "text": "↘",
                "cssClass": "btn-danger",
                "newModelValue": "fall",
            },
            3: {
                "text": "→",
                "cssClass": "btn-secondary",
                "newModelValue": "stay",
            }
        },
        "optionsSwitcher": {
            "rise": 1,
            "fall": 2,
            "stay": 3,
        },
    },
    'modal-enter-create': {
        "text": "Создать",
        "cssClass": "btn-primary",
        "additions": 'data-toggle="modal"',
    },
    'modal-enter-edit': {
        "text": "Редактировать",
        "cssClass": "btn-primary",
        "additions": 'data-toggle="modal"',
    },
    'modal-exit-edit': {
        "text": "Отменить",
        "cssClass": "btn-danger",
    },
    'modal-exit-edit-top': {
        "text": '<span aria-hidden="true">×</span>',
        "cssClass": "close",
    },
    'modal-save-edit': {
        "text": "Сохранить",
        "cssClass": "btn-success",
    },
}
export default ButtonsConfig