export class Observable {

    private data:any = null;

    protected callback:any = null;

    protected filterFunc:any = null;

    protected mapFunc:any = null;

    protected eachFunc:any = null;

    protected next:Observable = null;

    private queue:string[] = [];

    constructor (data?:any) {
        this.data = data;
    }

    public then (func:any):Observable {
        this.callback = func;
        if (typeof this.data !== "undefined") {
            this.data = this.callback.call(window, this.data);
        }
        this.next = new Observable(this.data);
        this.queue.push('then');
        return this.next;
    }

    public filter (func:any):Observable {
        if (this.data instanceof Array) {
            this.filterFunc = func;
            this.data = this.data.filter(func);
        }
        this.queue.push('filter');
        return this;
    }

    public map (func:any):Observable {
        if (this.data instanceof Array) {
            this.mapFunc = func;
            this.data = this.data.map(func);
        }
        this.queue.push('map');
        return this;
    }

    public each (func:any):Observable {
        if (this.data instanceof Array) {
            this.eachFunc = func;
            this.data.forEach(this.eachFunc);
        }
        this.queue.push('each');
        return this;
    }

    public update (data:any) {
        if (this.callback != null) {
            this.data = data;
            for (var i = 0, length = this.queue.length; i < length; i++) {
                switch (this.queue[i]) {
                    case 'filter':
                        if (this.filterFunc != null) {
                            this.filter(this.filterFunc);
                        }
                        break;
                    case 'map':
                        if (this.mapFunc != null) {
                            this.map(this.mapFunc);
                        }
                        break;
                    case 'then':
                        if (this.callback != null) {
                            this.data = this.callback.call(window, this.data);
                        }
                        break;
                    case 'each':
                        if (this.eachFunc != null) {
                            this.each(this.eachFunc);
                        }
                        break;
                }
            }
            if (this.next != null) {
                this.next.update(this.data);
            }
        }
    }

}
