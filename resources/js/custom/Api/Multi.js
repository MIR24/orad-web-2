import { csrf } from "../Config/Constants.js";
import SettingsDB from "../Utils/SettingsDB";
import { apiMethods } from "../Config/Constants.js";

export function simpleAjaxPromise (method, url, data) {
    var dataTemp = null;
    if (method === apiMethods.get) {
        dataTemp = data ? data : null;
    } else  {
        dataTemp = data ? { data } : null;
    }

    mApp.blockPage();
    return new Promise ((resolve, reject) => {
        $.ajax({
            headers: {
                'X-CSRF-Token': csrf,
            },
            url: url,
            method: method,
            data: dataTemp,
            success: data => {
                SettingsDB.checkHash(data.meta.settings_hash);
                resolve(data);
            },
            error: e => {
                reject(e);
            },
        });
    });
}