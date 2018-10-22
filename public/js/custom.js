const tabContentContainer = $('#tab-content'),
    bodyLoader = $('body');

var currentTab

function SwitchTab (tabName) {
    var formatters = {
          'Tops': Tops,
    }
    currentTab = new formatters[tabName]();
    currentTab.init();console.log(currentTab);
}