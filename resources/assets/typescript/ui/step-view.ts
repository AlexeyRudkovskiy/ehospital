class StepViewContainer {

    private nextStep:Element = null;

    private steps:Element[] = null;

    private currentStep = -1;

    constructor(private element:any) {
        this.nextStep = element.querySelector('.next-step');
        this.steps = element.querySelectorAll('.step');

        this.changeStep();
        this.nextStep.addEventListener('click', item => this.changeStep(this.currentStep + 1));
    }

    private changeStep(activeIndex:number = 0): void {
        if (activeIndex == this.steps.length) {
            if (this.element.hasAttribute('data-form')) {
                this.element.submit();
            }

            return;
        }
        for (var i = 0; i < this.steps.length; i++) {
            this.steps[i].classList.add('hidden');
        }
        this.steps[activeIndex].classList.remove('hidden');

        this.currentStep = activeIndex;
    }

}

export class StepView {

    public static create(): void {
        var stepable:any = document.querySelectorAll('.steps');
        if (stepable != null && stepable.length > 0) {
            for (var i = 0; i < stepable.length; i++) {
                stepable[i] = new StepViewContainer(stepable[i]);
            }
        }
    }

}