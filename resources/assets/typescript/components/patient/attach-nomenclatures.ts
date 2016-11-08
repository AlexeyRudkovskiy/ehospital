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

    private unitSelect:HTMLSelectElement = null;

    private fromDayInput:HTMLInputElement = null;

    private untilDayInput:HTMLInputElement = null;

    private amountInput:HTMLInputElement = null;

    private commentTextArea:HTMLTextAreaElement = null;

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
        this.nomenclatures = items.map(item => { return new Nomenclature(item.name_for_department, item.id, item.units); });
    }

    private popupLoaded(popup:Element): void {
        var addDay:any = popup.querySelector('#add_day');
        addDay.addEventListener('click', this.onAddDayButtonClicked.bind(this));
        this.nomenclatureSelect = popup.querySelector('#nomenclature_id') as HTMLSelectElement;
        this.unitSelect = popup.querySelector('#unit_id') as HTMLSelectElement;
        this.fromDayInput = popup.querySelector('#from_day') as HTMLInputElement;
        this.untilDayInput = popup.querySelector('#until_day') as HTMLInputElement;
        this.amountInput = popup.querySelector('#amount') as HTMLInputElement;
        this.commentTextArea = popup.querySelector('#comment') as HTMLTextAreaElement;
        this.popup = popup;

        this.clear(this.nomenclatureSelect);

        var option = document.createElement('option');
        option.setAttribute('value', '-1');
        option.innerHTML = '--------';
        this.nomenclatureSelect.appendChild(option);

        for (var i = 0; i < this.nomenclatures.length; i++) {
            option = document.createElement('option');
            option.setAttribute('value', this.nomenclatures[i].id as any);
            option.setAttribute('data-name', this.nomenclatures[i].name);
            option.innerHTML = this.nomenclatures[i].name;

            this.nomenclatureSelect.appendChild(option);
        }

        this.nomenclatureSelect.addEventListener('change', this.updateUnits.bind(this));
    }

    private updateUnits(): void {
        var value = parseInt(this.nomenclatureSelect.value);
        if (value === -1) return;

        var nomenclature:Nomenclature = null;

        for (var i = 0; i < this.nomenclatures.length; i++) {
            if (this.nomenclatures[i].id == value) {
                nomenclature = this.nomenclatures[i];
                break;
            }
        }

        this.clear(this.unitSelect);

        for (var i = 0; i < nomenclature.units.length; i++) {
            var option = document.createElement('option');
            option.setAttribute('value', nomenclature.units[i].id);
            option.setAttribute('data-text', nomenclature.units[i].text);
            option.innerHTML = nomenclature.units[i].text;

            this.unitSelect.appendChild(option);
        }
    }

    private onAddDayButtonClicked(): void {
        var nomenclatureDay = new NomenclatureDay(
            this.fromDayInput.value,
            this.untilDayInput.value,
            this.amountInput.value,
            this.nomenclatureSelect.value,
            this.nomenclatureSelect.options[this.nomenclatureSelect.selectedIndex].getAttribute('data-name'),
            this.unitSelect.value,
            this.unitSelect.options[this.unitSelect.selectedIndex].getAttribute('data-text'),
            this.commentTextArea.value
        );
        console.log(this.commentTextArea.value);
        this.nomenclaturesPerDay.push(nomenclatureDay);
    }

    private clear(target:Element): void {
        while (target.firstChild) {
            target.removeChild(target.firstChild);
        }
    }

}