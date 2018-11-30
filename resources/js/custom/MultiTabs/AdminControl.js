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
                'tabName': 'Настройки предложения'
            },
            'HelpRedacting': {
                'class': HelpRedacting,
                'tabName': 'Справка'
            },
            'WeatherTypes': {
                'class': WeatherTypes,
                'tabName': 'Тип погоде'
            },
            'Orbits': {
                'class': Orbits,
                'tabName': 'Орбите'
            },
        };
    }

    showHelp () {
        toastr.info('Таб упражнения')
    }
}
export default AdminControl