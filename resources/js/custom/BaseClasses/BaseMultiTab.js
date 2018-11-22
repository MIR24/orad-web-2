import { tabContentIdJQ } from "../Config/Constants.js";
import IdManipulation from "../Utils/IdManipulation.js";
import Listeners from "../Utils/Listeners.js";

class BaseMultiTab {
    constructor () {
        this.template = '';
        this.listeners = {};
        this.multiTabContentId = IdManipulation.getPreparedId('multi-base', this.constructor.name);
        this.currentTabClassVar = null;
        this.currentActiveTabId = '';
        this.tabsFormatter = {};
    }

    getTabTemplates () {
        return Object.keys(this.tabsFormatter).map(tabId => {
            this.addTabSwitchListeners(tabId);
            if (this.currentActiveTabId === tabId) {
                return `<li class="nav-item">
                    <a id="${tabId}" class="nav-link active show" data-toggle="tab" href="">${this.tabsFormatter[tabId].tabName}</a>
                </li>`;
            } else {
                return `<li class="nav-item">
                    <a id="${tabId}" class="nav-link" data-toggle="tab" href="">${this.tabsFormatter[tabId].tabName}</a>
                </li>`;
            }
        })
        .join('')
    }

    makeTemplate () {
        this.template = `<ul class="nav nav-tabs nav-fill m-0" role="tablist">
            ${this.getTabTemplates()}
        </ul>
        <div id="${this.multiTabContentId}" class="border border-top-0 m-0 pt-5"></div>`;
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
            this.currentActiveTabId = event.target.id;
            this.initActiveTab();

            console.log(event, this);
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