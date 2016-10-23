import { VueComponent, Prop } from 'vue-typescript'
import {EchoService} from "../../EchoService";

@VueComponent({
    template: require('/partials/contractor/addresses-list.html!text')
})
export class AddressesList {

    @Prop addresses:any = [];

    @Prop contractorId:number = 0;

    ready():void {
        this.contractorId = (<any>window).contractor.id;
        this.addresses = (<any>window).contractor.addresses;

        var name2 = 'eh.management.contractor.' + (this.contractorId) + '.address.created';
        EchoService.getInstance().on(name2)
            .then(this.onAddressCreated.bind(this));
    }

    private onAddressCreated(address): void {
        this.addresses.unshift(address);
    }

}