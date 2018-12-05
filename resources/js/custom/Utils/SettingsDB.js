import { simpleAjaxPromise } from "../Api/Multi.js";
import {
    settingsSeePremission,
    settingsDBUrlBase,
    apiMethods,
    toastrMessages } from "../Config/Constants.js";
import User from "../Utils/User.js";

const SettingsDB = {
    values: {},
    getSettings () {
        if (User.checkPermissions(settingsSeePremission)) {
            return simpleAjaxPromise(apiMethods.get, settingsDBUrlBase)
            .then((response) => {
                for (var one in response.data) {
                    this.values[response.data[one].param] = parseInt(response.data[one].value);
                }
            }, (error) => {
                toastr.error(toastrMessages.error.noData);
            });
        }
    }
}
export default SettingsDB