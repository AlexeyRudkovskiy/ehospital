import { VueComponent, Prop } from 'vue-typescript'
import {EchoService} from "../../EchoService";

@VueComponent({
    template: require('/partials/contractor/agreements-list.html!text')
})
export class AgreementsList {

    @Prop agreements:any = [];

    @Prop contractorId:number = 0;

    ready():void {
        this.contractorId = (<any>window).contractor.id;
        this.agreements = (<any>window).contractor.agreements;

        EchoService.getInstance().on('eh.contractor.' + (this.contractorId) + '.agreement.created')
            .then(this.onAddressCreated.bind(this));
    }

    private onAddressCreated(data): void {
        this.agreements.unshift(data.agreement);
    }

}