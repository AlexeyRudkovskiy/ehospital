import { VueComponent, Prop } from 'vue-typescript'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/income-medicaments/income-medicaments.html!text')
})
export class IncomeMedicaments {

    @Prop text:string = "test 2";

    @Prop medicaments:any = [];

    @Prop income:any = [];

    ready(): void {
        API.get('/api/medicaments')
            .then(response => response.json())
            .then(response => this.medicaments = response);
    }

    addIncome(): void {
        this.income.push({
            medicament: null,
            amount: null
        });
    }

}
