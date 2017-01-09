import {InlinePopup} from "../ui/inline-popup";
import {AjaxForm} from "../ui/ajax-form";
import {EchoService} from "../EchoService";
export class ContractorShow {

    /**
     * Address element
     * @var Element
     */
    protected address:Element;

    /**
     * Agreements element
     *
     * @var Element
     */
    protected agreements:Element;

    protected contractorId:number = 0;

    public constructor () {
        this.address = document.querySelector('#add_address');
        this.agreements = document.querySelector('#add_agreement');
        this.contractorId = (<any>this.address.getAttribute('data-contractor-id'));

        this.address.addEventListener('click', this.onAddressButtonClicked.bind(this));
        this.agreements.addEventListener('click', this.onAgreementButtonClicked.bind(this));
    }

    private onAddressButtonClicked():void {
        var popup = new InlinePopup(this.address, this.url('addAddress'), true, {
            close_after_form_submit: true
        });

        popup.setOnLoadedEventListener(function (data, popupInstance:InlinePopup) {
            var ajaxForm = new AjaxForm(data.querySelector('form'), function (response) {
                (<any>this).popupInstance.close();
                EchoService.getInstance().emit('eh.management.contractor.' + (this.instance.contractorId) + '.address.created', response.data.item);
            }.bind({
                popupInstance: popupInstance,
                instance: this
            }));
        }.bind(this));

        popup.show();
    }

    private onAgreementButtonClicked(): void {
        var popup = new InlinePopup(this.address, this.url('addAgreement'), true, {
            close_after_form_submit: true
        });

        popup.setOnLoadedEventListener(function (data, popupInstance:InlinePopup) {
            var ajaxForm = new AjaxForm(data.querySelector('form'), function (response) {
                (<any>this).popupInstance.close();
                EchoService.getInstance().emit('eh.management.contractor.' + (this.instance.contractorId) + '.agreement.created', response.data.item);
            }.bind({
                popupInstance: popupInstance,
                instance: this
            }));
        }.bind(this));

        popup.show();
    }

    private url(path:string):string {
        return "/management/contractor/" + ((<any>window).contractor.id) + "/" + path;
    }

}