import BaseTab from "../BaseClasses/BaseTab.js";
import AddEmptyBlockButton from "../Components/AddEmptyBlockButton.js";
import SaveButton from "../Components/SaveButton.js";
import DeleteButton from "../Components/DeleteButton.js";
import EnterEditingButton from "../Components/EnterEditingButton.js";
import CancelEditingButton from "../Components/CancelEditingButton.js";

class WeatherLive extends BaseTab {
    constructor () {
        super();
        this.url = '/test/weatherlive';
        this.listeners = {
            'click' : {},
            'input' : {},
        };
    }

    makeTemplate () {
        this.template = `1`;
    }

    makeBlock () {
        
    }
}
export default WeatherLive