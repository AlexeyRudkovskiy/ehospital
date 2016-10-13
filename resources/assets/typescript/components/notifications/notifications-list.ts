import { VueComponent, Prop } from 'vue-typescript'
import { Notification } from './notification'
import {MyService} from "../../MyService";

@VueComponent({
    template: require('/partials/notifications.html!text')
})
export class NotificationsList {

    @Prop notifications:Notification[] = [];

    ready():void {
        MyService.getInstance().on('eh.notification.' + ((<any>window)).uid).then(this.onNewNotification);

        if (typeof (<any>window).message !== "undefined") {
            var message = (<any>window).message;
            if (typeof message.actions === "undefined") {
                message.actions = [];
            }
            this.notifications.push(message);
        }
    }

    deleteNotification(index):void {
        this.notifications.splice(index, 1);
    }

    protected onNewNotification (item) {
        this.notifications.push(item);
    }

}
