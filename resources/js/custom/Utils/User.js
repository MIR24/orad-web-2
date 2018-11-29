import { simpleAjaxPromise } from "../Api/Multi.js";
import { apiMethods , toasterMessages } from "../Config/Constants.js";

const User = {
    isLoggedIn: false,
    premisions: {},
    
    getPremissions () {
        return simpleAjaxPromise(apiMethods.get, '/api/mypermissions')
        .then((response) => {
            this.premisions = response.data;
            this.isLoggedIn = true;
            toastr.success(toasterMessages.success.authPassed);
        }, (error) => {
            if (error.statusText == 'Unauthorized') {
                this.isLoggedIn = false;
                this.premisions = {};
                toastr.info(toasterMessages.info.notAuth);
            } else {
                toastr.error(toasterMessages.error.errorAuth);
            }
        });
    },

    checkPermissions (action) {
        for (var one in this.premisions) {
            if (this.premisions[one].name == action) {
                return true;
            }
        }
        return false;
    },
}
export default User