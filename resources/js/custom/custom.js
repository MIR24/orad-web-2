import { currentActive } from "./Config/Constants";
import User  from "./Utils/User.js";
import SettingsDB from "./Utils/SettingsDB";
import TabsConfig from "./Config/TabsConfig.js";
import Tops from "./Tabs/Tops.js";
import Newsbar from "./Tabs/Newsbar.js";
import Expedited from "./Tabs/Expedited.js";
import CurrencyValues from "./Tabs/CurrencyValues.js";
import WeatherLive from "./Tabs/WeatherLive.js";
import WeatherLiveLiner from "./Tabs/WeatherLiveLiner.js";
import TimeShift from "./Tabs/TimeShift.js";
import Countdown from "./Tabs/Countdown.js";
import Promo from "./Tabs/Promo.js";
import PhotoUpload from "./Tabs/PhotoUpload.js";
import AdminControl from "./MultiTabs/AdminControl.js";

window.addEventListener('DOMContentLoaded', () => {
    var arrayOfInitPromises = [
            User.getPremissions(),
        ];

    $.when.apply(null, arrayOfInitPromises).done(() => {
        SettingsDB.getSettings();
        TabsConfig.init();

        var tabCounter = 0;
        Array.from(document.querySelectorAll('a[id^=TabSwitch]')).forEach(tab => {
            const formatters = {
                  'Tops': Tops,
                  'Newsbar': Newsbar,
                  'Expedited': Expedited,
                  'CurrencyValues': CurrencyValues,
                  'WeatherLive': WeatherLive,
                  'WeatherLiveLiner': WeatherLiveLiner,
                  'TimeShift': TimeShift,
                  'Countdown': Countdown,
                  'Promo': Promo,
                  'PhotoUpload': PhotoUpload,
                  'AdminControl': AdminControl,
            };

            if (tabCounter === 0) {
                tab.parentElement.className += ' m-menu__item--hover';
                currentActive.init(new formatters[tab.attributes['data-tab-name'].value]());
                currentActive.tab.init();
            }

            tab.addEventListener('click', function(event) {
                currentActive.init(new formatters[this.attributes['data-tab-name'].value]());
                currentActive.tab.init();
            });
            tabCounter++;
        });

        $('#show-help-btn').click(function(event) {
            currentActive.tab.showHelp();
        });
    });
});

