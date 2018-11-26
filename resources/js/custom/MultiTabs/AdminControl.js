import BaseMultiTab from "../BaseClasses/BaseMultiTab.js";
import ConfigurationControl from "../Tabs/ConfigurationControl";
import HelpRedacting from "../Tabs/HelpRedacting";

class AdminControl extends BaseMultiTab {
    constructor () {
        super();
        this.currentActiveTabId = 'ConfigurationControl';
        this.tabsFormatter = {
            'ConfigurationControl': {
                'class': ConfigurationControl,
                'tabName': 'Настройки предложения'
            },
            'HelpRedacting': {
                'class': HelpRedacting,
                'tabName': 'Справка'
            },
        };
    }

    showHelp () {
        toastr.info('Таб упражнения')
    }
}
export default AdminControl