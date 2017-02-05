System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function onTabItemClicked() {
        var id = this.element.getAttribute('data-target');
        location.hash = this.element.getAttribute('data-target');
        this.container.links.forEach(function (item) {
            item.getAttribute('data-target') == id ? item.classList.add('active') : item.classList.remove('active');
        });
        this.container.contents.forEach(function (item) { return item.id == id ? item.show() : item.hide(); });
    }
    function createTabsContainer(element) {
        var container = new TabsContainer();
        var links = element.querySelectorAll('.tabs-navigation > *');
        var defaultItem = null;
        var hash = location.hash.substr(1, location.hash.length);
        container.element = element;
        for (var i = 0; i < links.length; i++) {
            var tabItem = links.item(i);
            if (!tabItem.classList.contains('dropdown')) {
                var tabContentContainer = new TabContentContainer();
                var id = tabItem.getAttribute('data-target');
                var selector = '.tabs-contents > [data-tab="' + id + '"]';
                container.links.push(tabItem);
                tabContentContainer.element = element.querySelector(selector);
                tabContentContainer.id = id;
                container.contents.push(tabContentContainer);
                tabItem.addEventListener('click', onTabItemClicked.bind({
                    element: tabItem,
                    container: container
                }));
                if (tabItem.hasAttribute('data-default') && hash.length === 0) {
                    defaultItem = tabItem;
                }
                if (hash.length > 0 && hash == id) {
                    defaultItem = tabItem;
                }
            }
            else {
            }
        }
        tabs.push(container);
        defaultItem.click();
    }
    function createTabs() {
        var tabsContainers = document.querySelectorAll('.tabs');
        for (var i = 0; i < tabsContainers.length; i++) {
            createTabsContainer(tabsContainers.item(i));
        }
    }
    exports_1("default", createTabs);
    var TabContentContainer, TabsContainer, tabs;
    return {
        setters: [],
        execute: function () {
            TabContentContainer = (function () {
                function TabContentContainer() {
                }
                TabContentContainer.prototype.show = function () {
                    this.element.classList.add('visible');
                };
                TabContentContainer.prototype.hide = function () {
                    this.element.classList.remove('visible');
                };
                return TabContentContainer;
            }());
            TabsContainer = (function () {
                function TabsContainer() {
                    this.links = [];
                    this.contents = [];
                }
                return TabsContainer;
            }());
            tabs = [];
        }
    };
});

//# sourceMappingURL=tabs.js.map
