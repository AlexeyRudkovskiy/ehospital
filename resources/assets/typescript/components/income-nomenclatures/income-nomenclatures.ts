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

    calculatePrice(item, index:number = -1): number {
        var batch:any = null;
        for (var i = 0; i < item.nomenclature.batches.length; i++) {
            if (item.nomenclature.batches[i].id == item.batch_id) {
                batch = item.nomenclature.batches[i];
                break;
            }
        }
        if (batch == null) { return; }

        var value:any = Number(item.amount) * batch.price;
        value = value.toFixed(2);
        if (index > -1) {
            var target:any = document.querySelector('#nomenclature_' + index + '_' + item.nomenclature_id);
            target.value = value;
        }
        return value;
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
                unit_id: -1,
                nomenclature_id: targetNomenclature.id
            });
        }
    }

    stringify(item:any, removeLargeFieldsInNomenclatures:boolean = false):string {
        if (removeLargeFieldsInNomenclatures) {
            item = JSON.parse(JSON.stringify(item));
            for (var i = 0; i < item.length; i++) {
                item[i].price = this.calculatePrice(item[i]);
                item[i].keep_records_by_series = item[i].nomenclature.keep_records_by_series;
                delete item[i].nomenclature;
                delete item[i].units;
                delete item[i].index;
            }
        }
        return JSON.stringify(item);
    }

    protected proccedEachNomenclature(nomenclatures:any): void {
        for (var i = 0; i < nomenclatures.length; i++) {
            nomenclatures[i].units = [nomenclatures[i].basic_unit, nomenclatures[i].base_unit];
        }

        return nomenclatures;
    }

}
