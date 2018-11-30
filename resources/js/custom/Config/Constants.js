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
        'authPassed': 'Вход выполнен',
    },
    'error': {
        'save': 'Ошибка сохранения',
        'update': 'Ошибка обновления',
        'noData': 'Ошибка получения данных',
        'delete': 'Ошибка удаления',
        'errorAuth': 'Ошибка авторизации',
        'maxNumFiles': 'Превышено максимальное количество изображений',
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
    'followPattern': 'follow patter ',
    'noMoreThan5': 'Максимальное количество символов: 5',
    'dataTimeAgain': 'Повторите ввод даты и времени',
    'onlyInteger': 'Введите целое число',
};
export const settingsDBUrlBase = '/api/settings';
export const weatherTypesUrlBase = '/api/weathertypes';
export const orbitsUrlBase = '/api/orbits';
