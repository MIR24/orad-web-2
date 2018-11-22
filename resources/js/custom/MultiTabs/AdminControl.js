import BaseMultiTab from "../BaseClasses/BaseMultiTab.js";
import ConfigurationControl from "../Tabs/ConfigurationControl";

class AdminControl extends BaseMultiTab {
    constructor () {
        super();
        this.currentActiveTabId = 'configurationControl';
        this.tabsFormatter = {
            'configurationControl': {
                'class': ConfigurationControl,
                'tabName': 'Настройки предложения'
            },
            'test1': {
                'class': ConfigurationControl,
                'tabName': 'Настройки предложения1'
            },
        };
    }
}
export default AdminControl