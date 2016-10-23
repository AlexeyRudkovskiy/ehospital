import { VueComponent, Prop } from 'vue-typescript'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/income-nomenclatures/income-nomenclatures.html!text')
})
export class IncomeNomenclatures {

    @Prop text:string = "test 2";

    @Prop nomenclatures:any = [];

    @Prop income:any = [];

    ready(): void {
        API.get('/api/nomenclatures')
            .then(response => response.json())
            .then(response => this.nomenclatures = response);
    }

    addIncome(): void {
        this.income.push({
            nomenclature: null,
            amount: null
        });
    }

}
