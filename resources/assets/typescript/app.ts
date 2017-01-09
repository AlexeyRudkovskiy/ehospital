/// <references path="../../typings/index.d.ts" />

import { Application } from './Application';
import * as Vue from 'vue'
import { router } from './routes'
import { get, set } from './helpers'
import { tabs } from './tabs'
import { initDiffs } from './diffs'

import { Balance } from './components/nomenclature/balance'
import { BatchesList } from './components/nomenclature/batches-list'
import { NotificationsList } from './components/notifications/notifications-list'
import { InputList } from './components/patient/inspection/input-list'
import { AddressesList } from './components/contractor/addresses-list'
import { AgreementsList } from './components/contractor/agreements-list'
import { IncomeNomenclatures } from "./components/income-nomenclatures/income-nomenclatures"
import { AttachNomenclatures } from "./components/patient/attach-nomenclatures"
import {StepView} from "./ui/step-view";
// import { Discussions } from './components/patient/discussions'

function executeRoute() {
    var routes = router();

    var page = get(window, 'page');
    var prefix = get(window, 'prefix');

    for (var i = 0; i < routes.length; i++) {
        if (routes[i].prefix === prefix) {
            for (var action in routes[i].actions) {
                if (action === page) {
                    // creating instance
                    var instance = new routes[i].actions[action];
                }
            }
        }
    }
}

function resizePageContent () {
    var pageContent:any = document.querySelector('#page-content');
    var pageHeader:any = document.querySelector('.content header.header');
    pageContent.style.height = (window.innerHeight - pageHeader.offsetHeight) + "px";
}

function sidebarSections () {
    var sidebarSections:any = document.querySelectorAll('.sidebar .section');
    for (var i = 0; i < sidebarSections.length; i++) {
        var header = sidebarSections[i].querySelector('.section-header');
        if (header != null) {
            header.addEventListener('click', function () {
                for (var i = 0; i < (<any>this).sections.length; i++) {
                    (<any>this).sections[i].classList.remove('active');
                }
                (<any>this).section.classList.toggle('active');
            }.bind({
                section: sidebarSections[i],
                sections: sidebarSections
            }));
        }
    }
}

(function () {

    var application:Application = Application.getInstance();

    console.log(application);

    application
        .addOnLoadedEvent(tabs)
        .addOnLoadedEvent(initDiffs)
        .addOnLoadedEvent(executeRoute)
        .addOnLoadedEvent(resizePageContent)
        .addOnLoadedEvent(StepView.create)
        .addOnResizeEvent(resizePageContent)
        .addOnLoadedOnceEvent(sidebarSections);

    application.emitOnLoadEvent();

    window.addEventListener('resize', function () {
        this.application.emitOnResizeEvent();
    }.bind({
        application: application
    }));

    var app = new Vue(<any>{
        el: () => 'body',
        components: [
            Balance,
            BatchesList,
            NotificationsList,
            InputList,
            AddressesList,
            AgreementsList,
            IncomeNomenclatures,
            AttachNomenclatures,
            // Discussions
        ]
    });

})();
