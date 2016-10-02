import { VueComponent, Prop } from 'vue-typescript'

@VueComponent({
    template: require('/partials/patient/discussions.html!text'),
    name: 'discussions'
})
export class Discussions {

    @Prop patientId:number = -1;

    @Prop comments:any = [];

    ready() : void {
        if (this.patientId < 1) {
            throw "patientId can't be lower than 1";
        }
        (<any>window).fetch('/api/patient/' + this.patientId + '/comments')
            .then(response => response.json())
            .then(response => { console.log(response); return response;})
            .then(response => this.comments = response);
    }

}