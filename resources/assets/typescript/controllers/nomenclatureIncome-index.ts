import {API} from "../api";
export class NomenclatureIncomeIndex {

    protected contractor_select:any = null;

    protected agreement_select:any = null;

    protected agreement_group:any = null;

    protected nomenclature_income_form:any = null;

    protected nextStep:any;

    protected steps:any = [];

    protected current:number = 0;

    constructor() {
        this.nextStep = document.querySelector('#nextStep');
        this.contractor_select = document.querySelector('#contractor_select');
        this.agreement_select = document.querySelector('#agreement_select');
        this.agreement_group = document.querySelector('#agreement_group');
        this.nomenclature_income_form = document.querySelector('#nomenclature_income_form');
        this.nextStep.addEventListener('click', this.onNextStepClicked.bind(this));
        this.contractor_select.addEventListener('change', this.onContractorChanged.bind(this));

        this.steps = document.querySelectorAll('.step');
    }

    private onNextStepClicked (): void {
        this.current++;
        if (this.current > this.steps.length - 1) {
            this.current = this.steps.length - 1;
            this.nomenclature_income_form.submit();
        }

        for (var i = 0; i < this.steps.length; i++) {
            if (i != this.current) {
                this.steps[i].classList.add('hidden');
            } else {
                this.steps[i].classList.remove('hidden');
            }
        }
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