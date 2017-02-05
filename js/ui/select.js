System.register(["../ui/popup/popup", "../lang", "../api"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function createOption(instance, data) {
        var option = document.createElement('div');
        data.element = option;
        option.innerHTML = data.text;
        option.setAttribute('data-value', data.value);
        option.classList.add('select-option');
        option.addEventListener('click', onItemSelected.bind({
            instance: instance,
            current: data
        }));
        if (data.isSelected === true) {
            option.classList.add('active');
        }
        return option;
    }
    function updateOptions(elements, instance) {
        instance.clearOption();
        var searchUrl = instance.searchUrl;
        elements = instance.processItems(elements);
        for (var i = 0; i < elements.length; i++) {
            var itemWrapper = elements[i];
            if (instance.selected !== null && instance.selected.value == itemWrapper.value) {
                itemWrapper.isSelected = true;
            }
            var option = null;
            if (typeof itemWrapper.createItem !== "undefined" && itemWrapper.createItem !== null) {
                option = itemWrapper.createItem(instance, itemWrapper);
            }
            else {
                option = createOption(instance, itemWrapper);
            }
            instance.optionsWrapper.appendChild(option);
        }
        currentPopup.setPopupLocation();
    }
    function timerTickEvent() {
        var _this = this;
        if (lastText === this.text) {
            api_1.default.post(this.instance.searchUrl, {
                text: this.text
            })
                .then(function (response) { return response.json(); })
                .then(function (elements) { return updateOptions(elements, _this.instance); });
        }
        else {
            window.clearTimeout(this.id);
        }
    }
    function onSearchBoxInput() {
        var text = this.searchInput.value;
        var eventArguments = {
            text: text,
            instance: this
        };
        lastText = text;
        eventArguments.id = window.setTimeout(timerTickEvent.bind(eventArguments), 200);
    }
    function onSelectChose() {
        if (currentPopup !== null) {
            currentPopup.close();
        }
        this.header.innerHTML = this.selected.text;
        this.element.value = this.selected.value;
        this.fireOnChangeEvent();
    }
    function createPopupFooter(selectContainer) {
        var container = document.createElement('div');
        var pullRight = document.createElement('div');
        var send = document.createElement('a');
        container.classList.add('popup-footer');
        pullRight.classList.add('pull-right');
        send.classList.add('ghost-btn', 'ghost-btn-primary');
        send.innerHTML = lang_1.default.get('ui.select.choose');
        send.setAttribute('href', 'javascript:');
        container.appendChild(pullRight);
        pullRight.appendChild(send);
        send.addEventListener('click', onSelectChose.bind(selectContainer));
        return container;
    }
    function onShowPopupSelectClicked() {
        var popup = new popup_1.default(null, this.title, this.subtitle);
        popup.basicContentBuilder = new PopupSelectContentBuilder();
        popup.isForm = true;
        popup.customClasses = ['custom-select-popup'];
        popup.footer = createPopupFooter(this);
        popup.create(this, true);
        popup.show();
        currentPopup = popup;
    }
    function setSelected(items, container) {
        var item = items.filter(function (item) { return item.isSelected; });
        if (item.length == 1) {
            item = item[0];
            container.header.innerHTML = item.text;
            container.selected = item;
            container.selected.isSelected = true;
            container.element.value = container.selected.value;
            container.fireOnChangeEvent();
        }
        else if (item.length > 1) {
            throw "Can't be multiple selected items";
        }
    }
    function onItemSelected() {
        for (var i = 0; i < this.instance.items.length; i++) {
            if (this.instance.items[i] !== this.current) {
                this.instance.items[i].element.classList.remove('active');
                this.instance.items[i].isSelected = false;
            }
        }
        this.current.element.classList.add('active');
        this.current.isSelected = true;
        this.instance.selected = this.current;
    }
    exports_1("onItemSelected", onItemSelected);
    function registerCreateSelectItem(path, createOptionCallback) {
        createOptionsCallbacks[path] = createOptionCallback;
    }
    exports_1("registerCreateSelectItem", registerCreateSelectItem);
    function select() {
        var rawSelects = (document.querySelectorAll('select'));
        var _loop_1 = function (i) {
            var container = new SelectContainer();
            var rawOptions = rawSelects[i].querySelectorAll('option');
            var header = document.createElement('div');
            var wrapper = document.createElement('div');
            var element = document.createElement('input');
            selects.push(container);
            container.items = [];
            container.header = header;
            container.wrapper = wrapper;
            container.useAjax = true;
            container.element = element;
            container.title = rawSelects[i].getAttribute('data-title');
            container.subtitle = rawSelects[i].hasAttribute('data-subtitle') ? rawSelects[i].getAttribute('data-subtitle') : '';
            element.type = 'hidden';
            element.name = rawSelects[i].getAttribute('name');
            header.classList.add('select-header');
            wrapper.classList.add('select', 'custom-select');
            wrapper.appendChild(header);
            wrapper.appendChild(element);
            header.addEventListener('click', onShowPopupSelectClicked.bind(container));
            if (rawSelects[i].hasAttribute('data-empty')) {
                container.emptyPlaceholder = rawSelects[i].getAttribute('data-empty');
            }
            else {
                container.emptyPlaceholder = lang_1.default.get('global.select.empty');
            }
            if (rawSelects[i].hasAttribute('data-search')) {
                container.isSearchable = true;
                container.searchUrl = rawSelects[i].getAttribute('data-search').replace(location.origin, '');
                if (rawSelects[i].hasAttribute('data-search-placeholder')) {
                    container.searchPlaceholder = rawSelects[i].getAttribute('data-search-placeholder');
                }
                else {
                    container.searchPlaceholder = lang_1.default.get('ui.select.search.placeholder');
                }
            }
            if (rawSelects[i].hasAttribute('data-search-alias')) {
                container.searchAliasUrl = rawSelects[i].getAttribute('data-search-alias').replace(location.origin, '');
            }
            if (typeof createOptionsCallbacks[container.searchAliasUrl] !== "undefined") {
                container.processItemCallback = createOptionsCallbacks[container.searchAliasUrl];
            }
            else if (typeof createOptionsCallbacks[container.searchUrl] !== "undefined") {
                container.processItemCallback = createOptionsCallbacks[container.searchUrl];
            }
            if (rawSelects[i].hasAttribute('data-preload') && rawSelects[i].getAttribute('data-preload').length > 0) {
                container.preloadUrl = rawSelects[i].getAttribute('data-preload');
                api_1.default.get(container.preloadUrl)
                    .then(function (response) { return response.json(); })
                    .then(container.processItems.bind(container))
                    .then(function (items) { setSelected(items, container); return items; })
                    .then(function (items) {
                    if (items.length < 1) {
                        header.innerHTML = container.emptyPlaceholder;
                    }
                });
            }
            else {
                for (var j = 0; j < rawOptions.length; j++) {
                    var item = {
                        text: rawOptions[j].innerHTML,
                        value: rawOptions[j].getAttribute('value'),
                        element: document.createElement('div'),
                        isSelected: false
                    };
                    container.items.push(item);
                }
                if (rawOptions.length < 1) {
                    header.innerHTML = container.emptyPlaceholder;
                }
                if (typeof rawSelects[i].options !== "undefined" &&
                    typeof rawSelects[i].options[rawSelects[i].selectedIndex] !== "undefined") {
                    header.innerHTML = rawSelects[i].options[rawSelects[i].selectedIndex].innerHTML;
                    container.selected = container.items[rawSelects[i].selectedIndex];
                    container.selected.isSelected = true;
                    element.value = container.selected.value;
                }
                else {
                    container.selected = null;
                }
            }
            rawSelects[i].parentElement.replaceChild(wrapper, rawSelects[i]);
            if (rawSelects[i].hasAttribute('id')) {
                containersAssociations[rawSelects[i].id] = container;
            }
        };
        for (var i = 0; i < rawSelects.length; i++) {
            _loop_1(i);
        }
        window.selects = selects;
    }
    exports_1("select", select);
    function findSelectById(id) {
        for (var key in containersAssociations) {
            if (id == key) {
                return containersAssociations[key];
            }
        }
        return null;
    }
    exports_1("findSelectById", findSelectById);
    var popup_1, lang_1, api_1, SelectContainer, selects, currentPopup, lastText, createOptionsCallbacks, containersAssociations, PopupSelectContentBuilder;
    return {
        setters: [
            function (popup_1_1) {
                popup_1 = popup_1_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (api_1_1) {
                api_1 = api_1_1;
            }
        ],
        execute: function () {
            SelectContainer = (function () {
                function SelectContainer() {
                    this.isSearchable = false;
                    this.searchUrl = "";
                    this.searchAliasUrl = "";
                    this.preloadUrl = "";
                    this.searchPlaceholder = "";
                    this.searchInput = null;
                    this.processItemCallback = null;
                    this.onItemSelectedCallbacks = [];
                }
                SelectContainer.prototype.clearOption = function () {
                    while (this.optionsWrapper.firstElementChild) {
                        this.optionsWrapper.removeChild(this.optionsWrapper.firstElementChild);
                    }
                    this.items.splice(0, this.items.length);
                };
                SelectContainer.prototype.processItems = function (items) {
                    this.items = this.processItemCallback !== null ? items.map(this.processItemCallback) : items;
                    return this.items;
                };
                SelectContainer.prototype.setPlaceholderText = function (text) {
                    var _this = this;
                    if (text === void 0) { text = null; }
                    if (text === null) {
                        if (this.emptyPlaceholder.length > 0) {
                            text = this.emptyPlaceholder;
                        }
                        else {
                            if (this.items.length < 1) {
                                throw {
                                    text: "Select container items is empty",
                                    container: this
                                };
                            }
                            var item = this.items.filter(function (item) { return item == _this.selected; });
                            if (item === null || item.length < 1) {
                                item = this.items[this.items.length - 1];
                            }
                            text = item.text;
                        }
                    }
                    this.header.innerHTML = text;
                };
                SelectContainer.prototype.addOnChangeEventListener = function (callback) {
                    this.onItemSelectedCallbacks.push(callback);
                };
                SelectContainer.prototype.fireOnChangeEvent = function () {
                    var _this = this;
                    this.onItemSelectedCallbacks.forEach(function (callback) { return callback.call(window, _this.selected, _this); });
                };
                return SelectContainer;
            }());
            exports_1("SelectContainer", SelectContainer);
            selects = [];
            currentPopup = null;
            lastText = null;
            createOptionsCallbacks = {};
            containersAssociations = {};
            PopupSelectContentBuilder = (function () {
                function PopupSelectContentBuilder() {
                }
                PopupSelectContentBuilder.prototype.build = function (data) {
                    var wrapper = document.createElement('div');
                    var items = data.items;
                    var itemsWrapper = document.createElement('div');
                    wrapper.classList.add('custom-select-wrapper');
                    if (data.isSearchable) {
                        var searchForm = document.createElement('form');
                        var searchBox = document.createElement('input');
                        wrapper.appendChild(searchForm);
                        searchForm.appendChild(searchBox);
                        searchForm.classList.add('select-search');
                        searchBox.placeholder = data.searchPlaceholder;
                        searchBox.addEventListener('input', onSearchBoxInput.bind(data));
                        data.searchInput = searchBox;
                    }
                    wrapper.appendChild(itemsWrapper);
                    data.optionsWrapper = itemsWrapper;
                    for (var i = 0; i < items.length; i++) {
                        var item = items[i];
                        var option = null;
                        if (typeof item.createItem !== "undefined" && item.createItem !== null) {
                            option = item.createItem(data, item);
                        }
                        else {
                            option = createOption(data, item);
                        }
                        itemsWrapper.appendChild(option);
                    }
                    return wrapper;
                };
                return PopupSelectContentBuilder;
            }());
        }
    };
});

//# sourceMappingURL=select.js.map
