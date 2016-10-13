import { VueComponent, Prop } from 'vue-typescript'
import { MyService } from '../../MyService'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/balance.html!text')
})
export class Balance {

    @Prop balance:number = 0.0;

    @Prop history:any = [];

    @Prop medicamentId:number = -1;

    ready ():void {
        API
            .get('/api/medicament/' + (this.medicamentId) + '/history')
            .then(response => response.json())
            .then(response => { this.history = response; });

        MyService.getInstance().on('eh.medicament.[0-9].history').then(this.onBalanceChanged.bind(this));
        MyService.getInstance().on('eh.medicament.[0-9].balance').then(this.onMedicamentChanged.bind(this));
    }

    private onMedicamentChanged(response): void {
        console.log(response, this);
    }

    private onBalanceChanged(response): void {
        this.history.unshift(response.history);
    }

}
