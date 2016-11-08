import { VueComponent, Prop } from 'vue-typescript'
import { Notification } from './notification'
import {EchoService} from "../../EchoService";
import {NotificationAction} from "./notification-action";

@VueComponent({
    template: require('/partials/notifications.html!text')
})
export class NotificationsList {

    @Prop notifications:Notification[] = [];

    ready():void {
        EchoService.getInstance().on('eh.notification.' + ((<any>window)).uid).then(this.onNewNotification);
        EchoService.getInstance().on('eh.nomenclature.request').then(this.onNewNomenclatureRequest);

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

    protected onNewNomenclatureRequest(item): void {
        var request:any = item.request;
        var notification = new Notification();
        notification.type = 'notification-default';
        notification.text = 'Новый запрос номенклатур';
        notification.actions = [
            new NotificationAction('открыть', 'javascript:alert(\'Method not implemented\')')
        ];

        this.notifications.push(notification);
    }

}
