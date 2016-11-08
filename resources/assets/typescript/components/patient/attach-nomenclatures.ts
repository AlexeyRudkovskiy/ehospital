import { VueComponent, Prop } from 'vue-typescript'
import { Nomenclature } from "./nomenclature";
import { API } from "../../api";
import { Popup } from "../../ui/popup";
import { NomenclatureDay } from "./nomenclature-day";

@VueComponent({
    template: require('/partials/patient/attach-nomenclatures.html!text')
})
export class AttachNomenclatures {

    private popup:Element = null;

    private nomenclatureSelect:HTMLSelectElement = null;

    private dayInput:HTMLInputElement = null;

    private amountInput:HTMLInputElement = null;

    private nomenclatures:Nomenclature[] = [];

    @Prop public nomenclaturesPerDay:NomenclatureDay[] = [];

    ready(): void {
        API.get('api/nomenclatures/?only=name_for_department,id')
            .then(response => (response as any).json())
            .then(this.onNomenclaturesLoaded);
    }

    public addNewDay(): void {
        var popup:Popup = new Popup('/test', true, {
            classes: [ 'popup-closable' ]
        });
        popup.setOnPopupLoaded(this.popupLoaded)
            .show();
    }

    public serialize(data:any): string {
        return JSON.stringify(data);
    }

    private onNomenclaturesLoaded(items): void {
        this.nomenclatures = items.map(item => { return new Nomenclature(item.name_for_department, item.id); });
    }

    private popupLoaded(popup:Element): void {
        var addDay:any = popup.querySelector('#add_day');
        addDay.addEventListener('click', this.onAddDayButtonClicked.bind(this));
        this.nomenclatureSelect = popup.querySelector('#nomenclature_id') as HTMLSelectElement;
        this.dayInput = popup.querySelector('#day') as HTMLInputElement;
        this.amountInput = popup.querySelector('#amount') as HTMLInputElement;
        this.popup = popup;

        this.clear(this.nomenclatureSelect);

        for (var i = 0; i < this.nomenclatures.length; i++) {
            var option = document.createElement('option');
            option.setAttribute('value', this.nomenclatures[i].id as any);
            option.innerHTML = this.nomenclatures[i].name;

            this.nomenclatureSelect.appendChild(option);
        }
    }

    private onAddDayButtonClicked(): void {
        var nomenclatureDay = new NomenclatureDay(
            this.dayInput.value,
            this.amountInput.value as number,
            this.nomenclatureSelect.value as number
        );
        this.nomenclaturesPerDay.push(nomenclatureDay);
    }

    private clear(target:Element): void {
        while (target.firstChild) {
            target.removeChild(target.firstChild);
        }
    }

}