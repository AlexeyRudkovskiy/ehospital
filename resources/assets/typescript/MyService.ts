import {Service} from './services/service'

export class MyService extends Service {

    protected io:any;

    protected ioPort:number = 5888;

    constructor () {
        super();
        this.io = new (<any>window).io(location.host + ":" + this.ioPort);
        this.io.on('message', this.onMessage.bind(this));
    }

    private onMessage(event):void {
        this.emit(event.channel, event.message.data);
    }

}