
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('schedule', require('./components/Schedule.vue'));

const app = new Vue({
    el: 'body'
});

var tabsInfo = [];

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

function onRevisionItemClicked () {
    this.classList.toggle('active');
}

function initTabs () {
    var tabs = document.querySelectorAll('nav.tabs');
    for (var i = 0; i < tabs.length; i++) {
        var targets = [];
        var defaultItem = null;
        if (tabs[i].hasAttribute('data-default') || typeof hashTable.activetab !== "undefined") {
            if (typeof hashTable.activetab !== "undefined") {
                defaultItem = hashTable.activetab;
            } else {
                defaultItem = tabs[i].getAttribute('data-default');
            }
        }

        for (var j = 0; j < tabs[i].childElementCount; j++) {
            var child = tabs[i].children[j];
            targets.push(child.getAttribute('data-target'));
            child.setAttribute('data-tabs-group', i);
            child.addEventListener('click', onTabItemClicked);
            var target = document.querySelector(child.getAttribute('data-target'));
            if (target != null) {
                target.classList.add('hidden');
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

window.onload = function () {
    var hash = location.hash;
    var i = 0;
    hash = hash.substr(1, hash.length);
    hash = hash.split('&');
    window.hashTable = {};
    for (i = 0; i < hash.length; i++) {
        hash[i] = hash[i].split('=');
    }

    for (i = 0; i < hash.length; i++) {
        var key = hash[i][0];
        var value = hash[i][1];
        hashTable[key] = value;
    }

    var revisions = document.querySelectorAll('.revision-item');
    for (i = 0; i < revisions.length; i++) {
        revisions[i].addEventListener('click', onRevisionItemClicked);
    }

    initTabs();
};
