export const csrf = $('meta[name="csrf-token"]').attr('content');
export const apiMethods = {
    'get': 'GET',
    'create': 'POST',
    'update': 'PUT',
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
    },
    'error': {
        'save': 'Ошибка сохранения',
        'update': 'Ошибка обновления',
        'noData': 'Ошибка получения данных',
        'delete': 'Ошибка удаления',
    },
    'warning': {
        'nothingToSave': 'Нет изменений',
    },
};