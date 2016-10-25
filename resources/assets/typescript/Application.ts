export class Application {

    protected onLoadEvents:any = [];

    protected onResizeEvents:any = [];

    protected onLoadOnceEvents:any = [];

    protected loaded: boolean = false;

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

    public addOnLoadedOnceEvent(event:any): Application {
        this.onLoadOnceEvents.push(event);
        return this;
    }

    public addOnResizeEvent (event:any): Application {
        this.onResizeEvents.push(event);
        return this;
    }

    public emitOnLoadEvent(): Application {
        if (!this.loaded) {
            for (var i = 0; i < this.onLoadOnceEvents.length; i++) {
                var event:any = this.onLoadOnceEvents[i];
                event.call(window);
            }

            this.loaded = true;
        }

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