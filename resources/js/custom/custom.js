import User  from "./Utils/User.js";
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
    var currentTab = null;

    User.getPremissions();

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

        if (tab.attributes['data-tab-active'].value == 'true') {
            currentTab = new formatters[tab.attributes['data-tab-name'].value]();
            currentTab.init();
        }

        tab.addEventListener('click', function(event) {
            currentTab = new formatters[this.attributes['data-tab-name'].value]();
            currentTab.init();
        });
    });

    $('#show-help-btn').click(function(event) {
        currentTab.showHelp();
    });
});

