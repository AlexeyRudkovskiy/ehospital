import {Observable} from './observable';

export class Service {

    private listeners:any = {};

    on(name:string):Observable {
        var observable = new Observable();
        if (typeof this.listeners[name] !== "undefined") {
            this.listeners[name].push(observable);
        } else {
            this.listeners[name] = [ observable ];
        }
        return observable;
    }

    emit (name, data):void {
        console.log(name, data);

        if (typeof this.listeners[name] !== "undefined") {
            for (var i = 0, length = this.listeners[name].length; i < length; i++) {
                this.listeners[name][i].update(data);
            }
            return;
        }

        for (var key in this.listeners) {
            if (this.match(<string>(key), name) && typeof this.listeners[key] !== "undefined") {
                for (var j = 0, length = this.listeners[key].length; j < length; j++) {
                    this.listeners[key][j].update(data);
                }
            }
        }
    }

    private match (pattern:string, value:string):boolean {
        pattern = pattern.replace('*', '([0-9a-zA-Z\.\,\\\/]+)');
        pattern = pattern.replace('[0-9]', '([0-9]+)');
        pattern = pattern.replace('[a-z]', '([a-zA-Z]+)');
        pattern += '$';

        return (new RegExp(pattern)).test(value);
    }

}