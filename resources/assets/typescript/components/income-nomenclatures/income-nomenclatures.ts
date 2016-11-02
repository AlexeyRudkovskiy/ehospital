import { VueComponent, Prop } from 'vue-typescript'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/income-nomenclatures/income-nomenclatures.html!text')
})
export class IncomeNomenclatures {

    @Prop text:string = "test 2";

    @Prop nomenclatures:any = [];

    @Prop income:any = [];

    @Prop nomenclature:any = -1;

    ready(): void {
        API.get('/api/nomenclatures')
            .then(response => (<any>response).json())
            .then(this.proccedEachNomenclature.bind(this))
            .then(response => this.nomenclatures = response);
    }

    addIncome(): void {
        var targetNomenclature = this.nomenclatures[this.nomenclature];
        this.income.push({
            nomenclature: targetNomenclature.name,
            amount: 22.12,
            units: targetNomenclature.units,
            unit: -1
        });
        //var items = {
        //    targetNomenclature: 'Hello world',
        //    amount: 12.57
        //};
        //this.income.push(items);
    }

    stringify(item:any):string {
        return JSON.stringify(item);
    }

    protected proccedEachNomenclature(nomenclatures:any): void {
        for (var i = 0; i < nomenclatures.length; i++) {
            nomenclatures[i].units = [nomenclatures[i].basic_unit, nomenclatures[i].base_unit];
        }

        return nomenclatures;
    }

}
