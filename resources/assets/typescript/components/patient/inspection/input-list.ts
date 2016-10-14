import { VueComponent, Prop } from 'vue-typescript'

@VueComponent({
    template: require('/partials/patient/inspection/inputList.html!text')
})
export class InputList {

    @Prop items:any[] = [];

    @Prop text:string = "Hello world";

    @Prop name:string;

    addItem():void {
        if (this.items.indexOf("") > -1) {
            return;
        }
        this.items.push("");
    }

}
