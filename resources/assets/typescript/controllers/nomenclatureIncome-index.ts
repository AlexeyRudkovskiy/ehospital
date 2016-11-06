import {API} from "../api";
export class NomenclatureIncomeIndex {

    protected contractor_select:any = null;

    protected agreement_select:any = null;

    protected agreement_group:any = null;

    protected nomenclature_income_form:any = null;

    constructor() {
        this.contractor_select = document.querySelector('#contractor_select');
        this.agreement_select = document.querySelector('#agreement_select');
        this.agreement_group = document.querySelector('#agreement_group');
        this.nomenclature_income_form = document.querySelector('#nomenclature_income_form');
        this.contractor_select.addEventListener('change', this.onContractorChanged.bind(this));
    }

    private onContractorChanged(): void {
        API.get('/api/contractor/' + (<any>this.contractor_select).value)
            .then(result => result.json())
            .then(this.contractorDidLoaded.bind(this));
    }

    private contractorDidLoaded(contractor): void {
        while (this.agreement_select.firstChild) {
            this.agreement_select.removeChild(this.agreement_select.firstChild);
        }

        var agreements = contractor.agreements;
        if (agreements.length < 1) {
            this.agreement_group.classList.add('hidden');
            return;
        } else {
            this.agreement_group.classList.remove('hidden');
        }
        for (var i = 0; i < agreements.length; i++) {
            var option = document.createElement('option');

            option.innerHTML = agreements[i].from + " - " + agreements[i].until;
            option.setAttribute('value', agreements[i].id);

            this.agreement_select.appendChild(option);
        }
    }

}