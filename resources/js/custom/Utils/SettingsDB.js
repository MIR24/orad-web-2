import { simpleAjaxPromise } from "../Api/Multi.js";
import {
    settingsSeePremission,
    settingsDBUrlBase,
    apiMethods,
    toastrMessages } from "../Config/Constants.js";
import User from "../Utils/User.js";
import TabsConfig from "../Config/TabsConfig.js";

const SettingsDB = {
    values: {},
    hash: null,
    checkHash (newHash) {
        if (this.hash !== null && this.hash !== newHash) {
            this.hash = null;
        }
    },
    getSettings (checkHashBool) {
        if (User.checkPermissions(settingsSeePremission) &&
            (!checkHashBool || checkHashBool && this.hash === null)) {
            return simpleAjaxPromise(apiMethods.get, settingsDBUrlBase)
            .then((response) => {
                for (var one in response.data) {
                    this.values[response.data[one].param] = parseInt(response.data[one].value);
                }
                this.hash = response.meta.settings_hash;
                TabsConfig.init();
            }, (error) => {
                toastr.error(toastrMessages.error.noData);
            });
        }
    }
}
export default SettingsDB