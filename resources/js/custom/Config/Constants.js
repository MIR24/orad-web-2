export const csrf =  $('meta[name="csrf-token"]').attr('content');
export const apiMethods = {
    'get': 'GET',
    'create': 'POST',
    'update': 'PUT',
    'delete': 'DELETE',
};