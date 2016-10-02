import { VueComponent, Prop } from 'vue-typescript'
import { Notification } from './notification'
import {MyService} from "../../MyService";

@VueComponent({
    template: require('/partials/notifications.html!text')
})
export class NotificationsList {

    @Prop notifications:Notification[] = [];

    ready():void {
        MyService.getInstance().on('eh.notification.1').then(this.onNewNotification);
    }

    deleteNotification(index):void {
        this.notifications.splice(index, 1);
    }

    protected onNewNotification (item) {
        console.log(item);
        this.notifications.push(item);
    }

}
