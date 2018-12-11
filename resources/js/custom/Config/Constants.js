export const currentActive = {
    tab: null,
    init (classVar) {
        this.tab = classVar;
        this.tab.init();
    }
};
export const csrf = $('meta[name="csrf-token"]').attr('content');
export const tabContentIdJQ = '#tab-content';
export const apiMethods = {
    'get': 'GET',
    'create': 'POST',
    'update': 'PATCH',
    'delete': 'DELETE',
};
export const toastrOptions = {
      "closeButton": true,
      "debug": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "1000",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "2000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
};
export const toastrMessages = {
    'success': {
        'save': 'Сохранено',
        'update': 'Обновлено',
        'delete': 'Удалено',
        'authPassed': 'Вход выполнен',
    },
    'error': {
        'save': 'Ошибка сохранения',
        'update': 'Ошибка обновления',
        'noData': 'Ошибка получения данных',
        'delete': 'Ошибка удаления',
        'errorAuth': 'Ошибка авторизации',
        'maxNumFiles': 'Превышено максимальное количество изображений',
        'charNotAllowed': 'Непозволение символ: ',
    },
    'warning': {
        'nothingToSave': 'Изменения не произведены',
    },
    'info': {
        'notAuth': 'Пользователь не зарегистрирован'
    },
};
export const validationMessages = {
    'requiredField': 'Обязательно для заполнения',
    'toManyChars': 'Превышено максимальное количество символов в строке',
    'noMoreThan': 'Максимальное количество символов: ',
    'noMoreThanInt': 'Максимальное количество цифр: ',
    'dataTimeAgain': 'Повторите ввод даты и времени',
    'onlyInteger': 'Введите целое число',
};
export const settingsDBUrlBase = '/api/settings';
export const settingsSeePremission = 'see_settings';
export const weatherTypesUrlBase = '/api/weathertypes';
export const orbitsUrlBase = '/api/orbits';
export const editTextLineAllowedChars = /[^a-zA-Zа-яА-ЯёЁ0-9\.\,\!\?\:\;\`\'\"\+\-\*\=\%\^\№\~\#\&\(\)\[\]\<\>\$\s]/;
