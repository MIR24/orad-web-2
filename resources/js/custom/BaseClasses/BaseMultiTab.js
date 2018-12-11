import { tabContentIdJQ } from "../Config/Constants.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";
import User from "../Utils/User.js";

class BaseMultiTab {
    constructor () {
        this.template = '';
        this.listeners = {};
        this.multiTabContentId = IdManipulation.getPreparedId('multi-base', this.constructor.name);
        this.currentTabClassVar = null;
        this.currentActiveTabId = '';
        this.tabsFormatter = {};
        this.tabActiveCss = 'bg-secondary active';
        this.hashCheck = {
            settings_hash: false,
        };
    }

    showHelp () {}

    getTabTemplates () {
        return Object.keys(this.tabsFormatter).map(tabId => {
            if (User.checkPermissions(this.tabsFormatter[tabId].seePremission)) {
                this.addTabSwitchListeners(tabId);
                return `<li class="nav-item">
                    <span id="${tabId}" class="btn nav-link ${this.currentActiveTabId === tabId ? this.tabActiveCss : ''}">
                        ${this.tabsFormatter[tabId].tabName}
                    </span>
                </li>`;
            }
        })
        .join('')
    }

    makeTemplate () {
        this.template = `<ul class="nav nav-tabs nav-fill m-0" role="tablist">
            ${this.getTabTemplates()}
        </ul>
        <div id="${this.multiTabContentId}" class="bg-secondary border border-top-0 m-0 pt-5"></div>`;
    }

    renderTemplate () {
        $(tabContentIdJQ).html(this.template);
    }

    initActiveTab () {console.log(this);
        this.currentTabClassVar = new this.tabsFormatter[this.currentActiveTabId].class(this.multiTabContentId);
        this.currentTabClassVar.init();
    }

    activateNewTab (event) {
        if (event.target.id !== this.currentActiveTabId) {
            $('#' + this.currentActiveTabId).removeClass(this.tabActiveCss);
            $(event.target).addClass(this.tabActiveCss);
            this.currentActiveTabId = event.target.id;
            this.initActiveTab();
        }
    }

    addTabSwitchListeners(tabName) {
        Listeners.add(this, { 'click':
            { [tabName]: {
                    'function': this.activateNewTab,
                    'class': this,
                }
            }
        });
    };

    initListeners () {
        Listeners.init(this);
    }

    init () {
        this.makeTemplate();
        this.renderTemplate();
        this.initListeners();
        this.initActiveTab();
        $('body').removeClass('m-page--loading');
    }
}
export default BaseMultiTab