import { VueComponent, Prop } from 'vue-typescript'
import { EchoService } from '../../EchoService'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/balance.html!text')
})
export class Balance {

    @Prop balance:number = 0.0;

    @Prop history:any = [];

    @Prop nomenclatureId:number = -1;

    ready ():void {
        API
            .get('/api/nomenclature/' + (this.nomenclatureId) + '/history')
            .then(response => response.json())
            .then(response => { this.history = response; });

        EchoService.getInstance().on('eh.nomenclature.[0-9].history').then(this.onBalanceChanged.bind(this));
        EchoService.getInstance().on('eh.nomenclature.[0-9].balance').then(this.onNomenclatureChanged.bind(this));
    }

    private onNomenclatureChanged(response): void {
        console.log(response, this);
    }

    private onBalanceChanged(response): void {
        this.history.unshift(response.history);
    }

}
