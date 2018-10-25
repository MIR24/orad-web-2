import Tops from "./tabs/Tops.js";
import Newsbar from "./tabs/Newsbar.js";
import Expedited from "./tabs/Expedited.js";
import CurrencyValues from "./tabs/CurrencyValues.js";

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
            }
            currentTab = new formatters[this.attributes['data-tab-name'].value]();
            currentTab.init();console.log(2, currentTab);
        });
    })
});

