import { VueComponent, Prop } from 'vue-typescript'

@VueComponent({
    template: require('/partials/patient/inspection/inputList.html!text')
})
export class InputList {

    @Prop items:any[] = [];

    @Prop editItems:any[] = [];

    @Prop text:string = "Hello world";

    @Prop name:string;

    @Prop editable:string = "";

    @Prop editableKey:string = "";

    private config:any = {};

    private suffices:any = {};

    ready(): void {
        if (this.editable !== "" && this.editable.length > 0) {
            this.editItems = this.getObject((<any>window), this.editable.split('.'));
        }

        this.config = (<any>window).config;
        if (typeof this.config !== 'undefined' && typeof this.config.suffixes !== "undefined") {
            this.suffices = this.config.suffixes;
        } else {
            this.suffices = {
                new: 'new',
                edit: 'edit'
            };
        }
    }

    addItem():void {
        if (this.items.indexOf("") > -1) {
            return;
        }
        this.items.push("");
    }

    getInputName(type:string, object:any = null): string {
        var baseInputName:string = this.name + '[' + (this.suffices[type]) + ']';
        if (type === 'new') {
            baseInputName += '[]';
        } else {
            if (object !== null) {
                baseInputName += '[' + object.id + ']';
            } else {
                throw "object can't be equals null";
            }
        }
        return baseInputName;
    }

    private getObject(object:any, path:string[]): any {
        if (path.length > 0) {
            var currentKey:string = path.shift();
            return this.getObject(object[currentKey], path);
        }
        return object;
    }

}
