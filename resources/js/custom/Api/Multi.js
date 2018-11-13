import { csrf } from "../Config/Constants.js";

export function simpleAjaxPromise (method, url, data) {
    $('body').addClass('m-page--loading');
    return new Promise ((resolve, reject) => {
        $.ajax({
            headers: {
                'X-CSRF-Token': csrf,
            },
            url: url,
            method: method,
            data: data ? { data } : null,
            success: data => {
                resolve(data);
            },
            error: e => {
                reject(e);
            },
        });
    });
}