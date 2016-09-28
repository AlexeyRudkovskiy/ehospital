import { VueComponent, Prop } from 'vue-typescript'
import { MyService } from '../MyService'

@VueComponent({
    template: '<b>Balance: {{ balance }}</b>'
})
export class BalanceComponent {

    @Prop balance:number = 0.0;

    ready ():void {
        MyService.getInstance().on('eh.medicament.[0-9].income').then(response => this.balance = response.balance);
    }

}