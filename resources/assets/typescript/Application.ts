export class Application {

    protected onLoadEvents:any = [];

    protected onResizeEvents:any = [];

    protected static instance:Application = null;

    constructor() {
    }

    public static getInstance(): Application {
        if (Application.instance == null) {
            Application.instance = new Application;
        }
        return Application.instance;
    }

    public addOnLoadedEvent (event:any): Application {
        this.onLoadEvents.push(event);
        return this;
    }

    public addOnResizeEvent (event:any): Application {
        this.onResizeEvents.push(event);
        return this;
    }

    public emitOnLoadEvent(): Application {
        for (var i = 0; i < this.onLoadEvents.length; i++) {
            var event:any = this.onLoadEvents[i];
            event.call(window);
        }
        return this;
    }

    public emitOnResizeEvent(): Application {
        for (var i = 0; i < this.onResizeEvents.length; i++) {
            var event:any = this.onResizeEvents[i];
            event.call(window);
        }
        return this;
    }

}