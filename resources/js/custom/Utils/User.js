import { simpleAjaxPromise } from "../Api/Multi.js";
import { apiMethods , toastrMessages } from "../Config/Constants.js";

const User = {
    isLoggedIn: false,
    premissions: {},
    
    getPremissions () {
        return simpleAjaxPromise(apiMethods.get, '/api/mypermissions')
        .then((response) => {
            this.premissions = response.data;
            this.isLoggedIn = true;
            toastr.success(toastrMessages.success.authPassed);
        }, (error) => {
            if (error.statusText == 'Unauthorized') {
                this.isLoggedIn = false;
                this.premissions = {};
                toastr.info(toastrMessages.info.notAuth);
            } else {
                toastr.error(toastrMessages.error.errorAuth);
            }
        });
    },

    checkPermissions (action) {
        for (var one in this.premissions) {
            if (this.premissions[one].name == action) {
                return true;
            }
        }
        return false;
    },
}
export default User