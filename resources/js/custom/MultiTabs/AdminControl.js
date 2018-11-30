import BaseMultiTab from "../BaseClasses/BaseMultiTab.js";
import ConfigurationControl from "../Tabs/ConfigurationControl";
import HelpRedacting from "../Tabs/HelpRedacting";
import WeatherTypes from "../Tabs/WeatherTypes";
import Orbits from "../Tabs/Orbits";

class AdminControl extends BaseMultiTab {
    constructor () {
        super();
        this.currentActiveTabId = 'ConfigurationControl';
        this.tabsFormatter = {
            'ConfigurationControl': {
                'class': ConfigurationControl,
                'tabName': 'Настройки приложения'
            },
            'HelpRedacting': {
                'class': HelpRedacting,
                'tabName': 'Справка'
            },
            'WeatherTypes': {
                'class': WeatherTypes,
                'tabName': 'Погода'
            },
            'Orbits': {
                'class': Orbits,
                'tabName': 'Орбиты'
            },
        };
    }

    showHelp () {
        toastr.info('Вы находитесь на закладке управления');
    }
}
export default AdminControl