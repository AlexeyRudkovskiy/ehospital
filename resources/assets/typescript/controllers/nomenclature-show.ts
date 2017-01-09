import { Popup } from '../ui/popup'
import { InlinePopup } from "../ui/inline-popup";
import { AjaxForm } from "../ui/ajax-form";

export class NomenclatureShow {

    /**
     * income button
     */
    protected income:Element;

    /**
     * outgoing button
     */
    protected outgoing:Element;

    constructor () {
        this.income = document.querySelector('#nomenclature_income');
        this.outgoing = document.querySelector('#nomenclature_outgoing');

        this.income.addEventListener('click', this.onIncomeButtonClicked.bind(this));
        this.outgoing.addEventListener('click', this.onOutgoingButtonClicked.bind(this));
    }

    private onIncomeButtonClicked():void {
        this.income.classList.add('mi-active');
        var popup = new InlinePopup(this.income, this.url('income'), true, {
            close_after_form_submit: true
        });
        popup.setOnLoadedEventListener(function (data, popupInstance:InlinePopup) {
            var ajaxForm = new AjaxForm(data.querySelector('form'), function (data) {
                (<any>this).popupInstance.close();
            }.bind({
                popupInstance: popupInstance
            }));
        });
        popup.setOnCloseEventListener(function () {
            this.income.classList.remove('mi-active');
        }.bind(this));
        popup.show();
    }


    private onOutgoingButtonClicked():void {
        this.outgoing.classList.add('mi-active');
        var popup = new InlinePopup(this.outgoing, this.url('outgoing'), true, {
            close_after_form_submit: true
        }).setOnLoadedEventListener(function (data, popupInstance:InlinePopup) {
            var ajaxForm = new AjaxForm(data.querySelector('form'), function (data) {
                (<any>this).popupInstance.close();
            }.bind({
                popupInstance: popupInstance
            }));
        }).setOnCloseEventListener(function () {
            this.outgoing.classList.remove('mi-active');
        }.bind(this));

        popup.show();
    }

    private url(path:string):string {
        return "/management/nomenclature/" + ((<any>window).nomenclature.id) + "/" + path;
    }

}