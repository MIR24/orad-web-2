export const currentActive = {
    tab: null,
    init (classVar) {
        this.tab = classVar;
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
export const toasterMessages = {
    'success': {
        'save': 'Сохранено',
        'update': 'Обновлено',
        'delete': 'Удалено',
        'authPassed': 'Успешная аутентификация',
    },
    'error': {
        'save': 'Ошибка сохранения',
        'update': 'Ошибка обновления',
        'noData': 'Ошибка получения данных',
        'delete': 'Ошибка удаления',
        'errorAuth': 'Ошибка авторизации',
        'maxNumFiles': 'Максимальное количество файлов превышено',
    },
    'warning': {
        'nothingToSave': 'Нет изменений',
    },
    'info': {
        'notAuth': 'Не зарегистрирован пользователь'
    },
};
export const validationMessages = {
    'requiredField': 'Обязательное поле',
    'toManyChars': 'chars error',
    'followPattern': 'follow patter ',
    'noMoreThan5': 'Максимум 5 букв',
    'dataTimeAgain': 'Выберите еще раз дату и время',
    'onlyInteger': 'Только целое число позволено ',
};
export const settingsDBUrlBase = '/api/settings';
export const weatherTypesUrlBase = '/api/weathertypes';
