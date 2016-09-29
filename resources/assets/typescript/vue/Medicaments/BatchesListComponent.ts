import { VueComponent, Prop, Watch } from 'vue-typescript'
import {MyService} from "../../MyService";

@VueComponent({
    template: require('/partials/batches-list-component.html!text')
})
export class BatchesListComponent {

    @Prop items:any = [];

    @Prop test:string = "Test";

    ready():void {
        MyService.getInstance().on('eh.medicament.[0-9].batch.created.*').then(item => this.onBatchCreated(item));
    }

    private onBatchCreated(event):void {
        this.items.push(event.batch);
        console.log(this);
    }

    @Watch('items')
    private testFunc () {
        console.log(arguments);
    }

}
