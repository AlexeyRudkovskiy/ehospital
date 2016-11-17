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

    private currentNomenclatureDay:NomenclatureDay = null;

    private currentNomenclatureDayIndex:number = 0;

    @Prop public nomenclaturesPerDay:NomenclatureDay[] = [];

    @Prop public review:boolean = false;

    @Prop public viewOnly:boolean = false;

    ready(): void {
        API.get('api/nomenclatures/?only=name_for_department,id')
            .then(response => (response as any).json())
            .then(this.onNomenclaturesLoaded);

        if (this.review) {
            for (var i = 0; i < (window as any).review.data.length; i++) {
                var item:any = (window as any).review.data[i];
                var nomenclatureDay:NomenclatureDay = new NomenclatureDay(
                    item._from_day,
                    item._until_day,
                    item._amount,
                    item._nomenclature_id,
                    item._nomenclature,
                    item._unit_id,
                    item._unit,
                    item._comment
                );

                this.nomenclaturesPerDay.push(nomenclatureDay);
            }
        }
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

    public isDisabled(): boolean {
        if (this.viewOnly)
            return true;
        return !this.review;
    }

    public edit(index:number): void {
        var popup:Popup = new Popup('/test', true, {
            classes: [ 'popup-closable' ]
        });

        this.currentNomenclatureDay = this.nomenclaturesPerDay[index];
        this.currentNomenclatureDayIndex = index;

        popup
            .setOnPopupLoaded(this.editPopupLoaded.bind(this))
            .show();
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

    private editPopupLoaded(popup:Element): void {
        var save:any = popup.querySelector('#add_day');
        save.addEventListener('click', this.onSaveButtonClicked.bind(this));
        this.nomenclatureSelect = popup.querySelector('#nomenclature_id') as HTMLSelectElement;
        this.unitSelect = popup.querySelector('#unit_id') as HTMLSelectElement;
        this.fromDayInput = popup.querySelector('#from_day') as HTMLInputElement;
        this.untilDayInput = popup.querySelector('#until_day') as HTMLInputElement;
        this.amountInput = popup.querySelector('#amount') as HTMLInputElement;
        this.commentTextArea = popup.querySelector('#comment') as HTMLTextAreaElement;
        this.popup = popup;

        this.clear(this.nomenclatureSelect);

        this.fromDayInput.value = this.currentNomenclatureDay.from_day;
        this.untilDayInput.value = this.currentNomenclatureDay.until_day;
        this.amountInput.value = this.currentNomenclatureDay.amount.toString();
        this.commentTextArea.value = this.currentNomenclatureDay.comment;

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

            if (this.nomenclatures[i].id == this.currentNomenclatureDay.nomenclature_id) {
                this.nomenclatureSelect.selectedIndex = i + 1;
            }
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

            if (this.currentNomenclatureDay != null && nomenclature.units[i].id == this.currentNomenclatureDay.unit_id) {
                this.unitSelect.selectedIndex = i;
            }
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

    private onSaveButtonClicked(): void {
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].from_day = this.fromDayInput.value;
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].until_day = this.untilDayInput.value;
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].amount = Number(this.amountInput.value);
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].nomenclature_id = Number(this.nomenclatureSelect.value);
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].nomenclature = this.nomenclatureSelect.options[this.nomenclatureSelect.selectedIndex].getAttribute('data-name');
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].unit_id = this.unitSelect.value;
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].unit = this.unitSelect.options[this.unitSelect.selectedIndex].getAttribute('data-text');
        this.nomenclaturesPerDay[this.currentNomenclatureDayIndex].comment = this.commentTextArea.value;
    }

    private clear(target:Element): void {
        while (target.firstChild) {
            target.removeChild(target.firstChild);
        }
    }

}