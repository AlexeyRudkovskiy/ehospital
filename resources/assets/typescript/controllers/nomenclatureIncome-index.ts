export class NomenclatureIncomeIndex {

    protected nextStep:any;

    protected steps:any = [];

    protected current:number = 0;

    constructor() {
        this.nextStep = document.querySelector('#nextStep');
        this.nextStep.addEventListener('click', this.onNextStepClicked.bind(this));

        this.steps = document.querySelectorAll('.step');
    }

    private onNextStepClicked (): void {
        this.current++;
        if (this.current > this.steps.length - 1) {
            this.current = this.steps.length - 1;
        }

        for (var i = 0; i < this.steps.length; i++) {
            if (i != this.current) {
                this.steps[i].classList.add('hidden');
            } else {
                this.steps[i].classList.remove('hidden');
            }
        }
    }

}