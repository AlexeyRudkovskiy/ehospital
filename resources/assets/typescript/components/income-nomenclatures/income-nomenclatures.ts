import { VueComponent, Prop, Watch } from 'vue-typescript'
import {API} from "../../api";

@VueComponent({
    template: require('/partials/income-nomenclatures/income-nomenclatures.html!text')
})
export class IncomeNomenclatures {

    @Prop text:string = "test 2";

    @Prop nomenclatures:any = [];

    @Prop income:any = [];

    @Prop nomenclature:any = -1;

    get test():string {
        return ;
    }

    calculatePrice(item): void {
        var batch:any = null;
        var index = -1;
        for (var i = 0; i < item.nomenclature.batches.length; i++) {
            if (item.nomenclature.batches[i].id == item.batch) {
                batch = item.nomenclature.batches[i];
                break;
            }
        }
        if (batch == null) { return; }

        for (var i = 0; i < this.income.length; i++) {
            if (this.income[i].nomenclatureId == item.nomenclatureId) {
                index = i;
                break;
            }
        }

        if (index < 0) {
            return;
        }

        var target = document.querySelector('#nomenclature_' + index + '_' + item.nomenclatureId);
        target.value = Number(item.amount) * batch.price;
    }

    ready(): void {
        API.get('/api/nomenclatures')
            .then(response => (<any>response).json())
            .then(this.proccedEachNomenclature.bind(this))
            .then(response => this.nomenclatures = response);
    }

    addIncome(): void {
        var targetNomenclature = this.nomenclatures[this.nomenclature];
        if (targetNomenclature != null) {
            this.income.push({
                nomenclature: targetNomenclature,
                amount: 22.12,
                units: targetNomenclature.units,
                unit: -1,
                nomenclatureId: targetNomenclature.id
            });
        }
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
