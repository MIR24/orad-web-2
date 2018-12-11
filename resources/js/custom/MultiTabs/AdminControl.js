import BaseMultiTab from "../BaseClasses/BaseMultiTab.js";
import ConfigurationControl from "../Tabs/ConfigurationControl";
import HelpRedacting from "../Tabs/HelpRedacting";
import WeatherTypes from "../Tabs/WeatherTypes";
import Orbits from "../Tabs/Orbits";
import PromoCategories from "../Tabs/PromoCategories";

class AdminControl extends BaseMultiTab {
    constructor () {
        super();
        this.currentActiveTabId = 'ConfigurationControl';
        this.tabsFormatter = {
            'ConfigurationControl': {
                "seePremission": "see_settings",
                'class': ConfigurationControl,
                'tabName': 'Настройки приложения',
            },
            'HelpRedacting': {
                "seePremission": "see_tabs",
                'class': HelpRedacting,
                'tabName': 'Справка'
            },
            'WeatherTypes': {
                "seePremission": "see_weathertypes",
                'class': WeatherTypes,
                'tabName': 'Погода',
            },
            'Orbits': {
                "seePremission": "see_orbits",
                'class': Orbits,
                'tabName': 'Орбиты',
            },
            'PromoCategories': {
                "seePremission": "see_promocategories",
                'class': PromoCategories,
                'tabName': 'Промо категории',
            },
        };
    }

    showHelp () {
        toastr.info('Вы находитесь на закладке управления');
    }
}
export default AdminControl