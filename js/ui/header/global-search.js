System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function onInput() {
        if (this.classList.contains('active')) {
            searchResults.style.width = this.offsetWidth + "px";
            searchResults.classList.remove('hide');
            // сделать так что бы иконка отображалась лишь когда идёт загрузка
            this.parentElement.classList.add('loading');
            searchResults.style.marginLeft = searchInput.offsetLeft + "px";
        }
        else {
            searchResults.classList.add('hide');
            this.parentElement.classList.remove('loading');
        }
    }
    function default_1() {
        var searchContainer = document.querySelector('#global-search');
        searchInput = searchContainer.querySelector('#global-search-input');
        searchResults = searchContainer.querySelector('.search-results');
        searchInput.removeEventListener('input', onInput);
        searchInput.addEventListener('input', onInput);
        searchResults.classList.add('hide');
    }
    exports_1("default", default_1);
    var searchInput, searchResults;
    return {
        setters: [],
        execute: function () {
        }
    };
});

//# sourceMappingURL=global-search.js.map
