import Tops from "./Tabs/Tops.js";
import Newsbar from "./Tabs/Newsbar.js";
import Expedited from "./Tabs/Expedited.js";
import CurrencyValues from "./Tabs/CurrencyValues.js";
import WeatherLive from "./Tabs/WeatherLive.js";
import TimeShift from "./Tabs/TimeShift.js";
import Countdown from "./Tabs/Countdown.js";
import Promo from "./Tabs/Promo.js";

var currentTab = null;

window.addEventListener('DOMContentLoaded', () => {
    currentTab = new Tops();
    currentTab.init();console.log(1, currentTab);

    var TabSwitchs = document.querySelectorAll('a[id^=TabSwitch]');
    Array.from(TabSwitchs).forEach(tab => {
        tab.addEventListener('click', function(event) {
            var formatters = {
                  'Tops': Tops,
                  'Newsbar': Newsbar,
                  'Expedited': Expedited,
                  'CurrencyValues': CurrencyValues,
                  'WeatherLive': WeatherLive,
                  'TimeShift': TimeShift,
                  'Countdown': Countdown,
                  'Promo': Promo,
            }
            currentTab = new formatters[this.attributes['data-tab-name'].value]();
            currentTab.init();console.log(2, currentTab);
        });
    })
});

