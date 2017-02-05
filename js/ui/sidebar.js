System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function documentOnClickCallback(e) {
        var current = document.elementFromPoint(e.clientX, e.clientY);
        if (!lockSidebar) {
            while (current != sidebarWrapper) {
                if (current == null || current.tagName == 'html'.toUpperCase() || current.classList.contains('sidebar-wrapper')) {
                    break;
                }
                current = current.parentElement;
            }
            if (current != sidebarWrapper) {
                sidebarWrapper.classList.remove('active');
                document.removeEventListener('click', documentOnClickCallback, false);
                if (submenu != null) {
                    submenu.parentNode.removeChild(submenu);
                    sidebar.style.display = "block";
                    sidebarWrapper.style.transition = "width 2s";
                    sidebarWrapper.style.height = initialHeight + "px";
                    submenu = null;
                }
            }
        }
        lockSidebar = false;
    }
    function groupHeaderOnClickListener(event) {
        if (window.innerWidth <= responsiveMobileMaxWidth) {
            lockSidebar = true;
            var innerList = this.parentElement.getElementsByTagName('ul')[0];
            var cloned = innerList.cloneNode(true);
            var localSidebarWrapper = document.createElement('div');
            if (initialHeight == 0) {
                initialHeight = sidebarWrapper.offsetHeight;
            }
            localSidebarWrapper.classList.add('sidebar');
            sidebar.style.display = 'none';
            sidebarWrapper.appendChild(localSidebarWrapper);
            localSidebarWrapper.appendChild(cloned);
            sidebarWrapper.style.height = cloned.offsetHeight + "px";
            submenu = localSidebarWrapper;
        }
        else {
            if (this.parentElement.tagName.toLowerCase() == 'li') {
                var items = sidebar.querySelectorAll('ul > li');
                for (var i = 0; i < items.length; i++) {
                    items[i].classList.remove('active');
                }
                this.parentElement.classList.add('active');
            }
        }
    }
    function updateSidebar() {
        if (sidebarWrapper === null) {
            sidebarWrapper = document.querySelector('.sidebar-wrapper');
            sidebar = document.querySelector('.sidebar');
            menuButton = document.querySelector('.app-header .menu');
        }
        var items = sidebar.querySelectorAll('a[data-list-header]');
        var item = null;
        menuButton.addEventListener('click', function () {
            sidebarWrapper.classList.add('active');
            window.setTimeout(function () { return document.addEventListener('click', documentOnClickCallback, false); }, 100);
        });
        for (var i = 0; i < items.length; i++) {
            item = items[i];
            item.addEventListener('click', groupHeaderOnClickListener);
        }
    }
    exports_1("default", updateSidebar);
    var sidebarWrapper, sidebar, menuButton, submenu, active, initialHeight, lockSidebar, responsiveMobileMaxWidth;
    return {
        setters: [],
        execute: function () {
            sidebarWrapper = null;
            sidebar = null;
            menuButton = null;
            submenu = null;
            active = null;
            initialHeight = 0;
            lockSidebar = false;
            responsiveMobileMaxWidth = 1024;
        }
    };
});

//# sourceMappingURL=sidebar.js.map
