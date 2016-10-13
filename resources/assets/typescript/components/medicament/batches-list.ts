/// <reference path="../../../../../typings/index.d.ts" />

import { VueComponent, Prop, Watch } from 'vue-typescript'
import {MyService} from "../../MyService";

@VueComponent({
    template: require('/partials/batches-list.html!text')
})
export class BatchesList {

    @Prop items:any = [];

    ready():void {
        MyService.getInstance().on('eh.medicament.[0-9].batch.created.*').then(item => this.onBatchCreated(item));
    }

    private onBatchCreated(event):void {
        this.items.push(event.batch);
    }

    @Watch('items')
    private testFunc () {
        console.log(arguments);
    }

    private onBatchModified() {

    }

}
