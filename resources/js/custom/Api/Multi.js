import { csrf } from "../Config/Constants.js";
import SettingsDB from "../Utils/SettingsDB";
import { apiMethods } from "../Config/Constants.js";

export function simpleAjaxPromise (method, url, data) {
    mApp.blockPage();
    return new Promise ((resolve, reject) => {
        var options = {
                headers: {
                    'X-CSRF-Token': csrf,
                },
                url: url,
                method: method,
                success: data => {
                    SettingsDB.checkHash(data.meta.settings_hash);
                    resolve(data);
                },
                error: e => {
                    reject(e);
                },
            };

        if (method === apiMethods.get) {
            Object.assign(options, {
                data: data ? data : null,
            });
        } else  {
            Object.assign(options, {
                data:  data ? JSON.stringify({ data }) : null,
                contentType: 'application/json',
            });
        }

        $.ajax(options);
    });
}