import { Popup } from '../ui/popup'

export class MedicamentShow {

    /**
     * income button
     */
    protected income:Element;

    /**
     * outgoing button
     */
    protected outgoing:Element;

    constructor () {
        this.income = document.querySelector('#medicament_income');
        this.outgoing = document.querySelector('#medicament_outgoing');

        this.income.addEventListener('click', this.onIncomeButtonClicked.bind(this));
        this.outgoing.addEventListener('click', this.onOutgoingButtonClicked.bind(this));
    }

    private onIncomeButtonClicked():void {
        var popup = new Popup(this.url('income'), true, {
            close_after_form_submit: true
        });
        popup.show();
    }

    private onOutgoingButtonClicked():void {
        var popup = new Popup(this.url('outgoing'), true, {
            close_after_form_submit: true
        });
        popup.show();
    }

    private url(path:string):string {
        return "/management/medicament/" + ((<any>window).medicament.id) + "/" + path;
    }

}