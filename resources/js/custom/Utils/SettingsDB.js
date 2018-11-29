import { simpleAjaxPromise } from "../Api/Multi.js";
import { settingsDBUrlBase, apiMethods , toasterMessages } from "../Config/Constants.js";

const SettingsDB = {
    values: {},
    getSettings () {
        return simpleAjaxPromise(apiMethods.get, settingsDBUrlBase)
        .then((response) => {
            for (var one in response.data) {
                this.values[response.data[one].param] = parseInt(response.data[one].value);
            }
        }, (error) => {
            toastr.error(toasterMessages.error.noData);
        });
    }
}
export default SettingsDB