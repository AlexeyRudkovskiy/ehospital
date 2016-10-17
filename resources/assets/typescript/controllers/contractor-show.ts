import {InlinePopup} from "../ui/inline-popup";
export class ContractorShow {

    /**
     * Address element
     * @var Element
     */
    protected address:Element;

    public constructor () {
        this.address = document.querySelector('#add_address');

        this.address.addEventListener('click', this.onAddressButtonClicked.bind(this));
    }

    private onAddressButtonClicked():void {
        var popup = new InlinePopup(this.address, this.url('addAddress'), true, {
            close_after_form_submit: true
        });

        popup.show();
    }

    private url(path:string):string {
        return "/management/contractor/" + ((<any>window).contractor.id) + "/" + path;
    }

}