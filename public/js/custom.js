const tabContentContainer = $('#tab-content'),
    bodyLoader = $('body');

function SwitchTab (tabName) {
    var formatters = {
          'Tops': Tops,
          'Newsbar': Newsbar,
          'Expedited': Expedited,
    }
    var currentTab = new formatters[tabName]();
    currentTab.init();console.log(currentTab);
}