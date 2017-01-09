import {Service} from './services/service'

export class EchoService extends Service {

    protected io:any = null;

    protected ioPort:number = 5888;

    private static instance:EchoService = null;

    constructor () {
        super();
        this.io = new (<any>window).io.connect(location.host + ":" + this.ioPort);
        this.io.on('message', this.onMessage.bind(this));
        EchoService.instance = this;
    }

    private onMessage(event):void {
        this.emit(event.channel, event.message.data);
    }

    static getInstance () {
        if (EchoService.instance === null) {
            EchoService.instance = new EchoService();
        }

        return EchoService.instance;
    }

}