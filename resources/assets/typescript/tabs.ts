var tabsInfo:any = [];

function onTabItemClicked () {
    var childrens = this.parentElement.children;
    var tabsGroupId = this.getAttribute('data-tabs-group');
    var tabsGroupTargets = tabsInfo[tabsGroupId];
    var i = 0;
    var target = null;

    for (i = 0; i < childrens.length; i++) {
        if (childrens[i] !== this) {
            childrens[i].classList.remove('active');
        }
    }

    for (i = 0; i < tabsGroupTargets.length; i++) {
        if (tabsGroupTargets[i] !== null) {
            target = document.querySelector(tabsGroupTargets[i]);
            if (target !== null) {
                target.classList.add('hidden');
            }
        }
    }

    this.classList.add('active');
    target = document.querySelector(this.getAttribute('data-target'));
    if (target !== null) {
        target.classList.remove('hidden');
    }

    location.hash = "activetab=" + this.getAttribute('data-target');
}


function initTabs () {
    var tabs = document.querySelectorAll('nav.tabs');
    for (var i = 0; i < tabs.length; i++) {
        var targets = [];
        var defaultItem = null;
        if (tabs[i].hasAttribute('data-default') || typeof (<any>window).hashTable.activetab !== "undefined") {
            if (typeof (<any>window).hashTable.activetab !== "undefined") {
                defaultItem = (<any>window).hashTable.activetab;
            } else {
                defaultItem = tabs[i].getAttribute('data-default');
            }
        }

        for (var j = 0; j < tabs[i].childElementCount; j++) {
            var child = (<any>tabs[i]).children[j];
            if (!child.hasAttribute('data-target')) {
                continue;
            }
            targets.push(child.getAttribute('data-target'));
            child.setAttribute('data-tabs-group', <any>i);
            child.addEventListener('click', onTabItemClicked);
            var target = document.querySelector(child.getAttribute('data-target'));
            if (target != null) {
                target.classList.add('hidden');
            }

            if (target.classList.contains('tab-full-size')) {
                // todo: fix this
                var height = window.innerHeight - (document.querySelector('header.header') as any).offsetHeight;
                console.log(height);
                (target as any).width = target.parentElement.offsetWidth + 'px';
                (target as any).height = height + 'px';
            }

            if (defaultItem !== null && child.getAttribute('data-target') == defaultItem) {
                defaultItem = child;
            }
        }

        tabsInfo.push(targets);

        if (defaultItem !== null) {
            //debugger;
            if (typeof defaultItem === "object") {
                onTabItemClicked.apply(defaultItem);
            }
        }
    }
}

export function tabs () {

    var hash:any = location.hash;
    var i = 0;
    hash = hash.substr(1, hash.length);
    hash = hash.split('&');
    (<any>window).hashTable = {};
    for (i = 0; i < hash.length; i++) {
        hash[i] = hash[i].split('=');
    }

    for (i = 0; i < hash.length; i++) {
        var key = hash[i][0];
        var value = hash[i][1];
        (<any>window).hashTable[key] = value;
    }

    initTabs();

}