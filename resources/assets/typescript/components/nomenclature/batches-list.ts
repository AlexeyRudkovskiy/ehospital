/// <reference path="../../../../../typings/index.d.ts" />

import { VueComponent, Prop, Watch } from 'vue-typescript'
import {EchoService} from "../../EchoService";

@VueComponent({
    template: require('/partials/batches-list.html!text')
})
export class BatchesList {

    @Prop items:any = [];

    ready():void {
        EchoService.getInstance().on('eh.nomenclature.[0-9].batch.created.*').then(item => this.onBatchCreated(item));
    }

    private onBatchCreated(event):void {
        this.items.push(event.batch);
    }

    private onBatchModified() {

    }

}
