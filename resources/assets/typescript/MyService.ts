import {Service} from './services/service'

export class MyService extends Service {

    protected io:any = null;

    protected ioPort:number = 5888;

    private static instance:MyService = null;

    constructor () {
        super();
        this.io = new (<any>window).io.connect(location.host + ":" + this.ioPort);
        this.io.on('message', this.onMessage.bind(this));
        MyService.instance = this;
    }

    private onMessage(event):void {
        this.emit(event.channel, event.message.data);
    }

    static getInstance () {
        if (MyService.instance === null) {
            MyService.instance = new MyService();
        }

        return MyService.instance;
    }

}