export class API {

    public static instance:API = null;

    constructor(private _token:string) {
    }

    public static getInstance():API {
        if (API.instance === null) {
            API.instance = new API((<any>window).token);
        }
        return API.instance;
    }

    public static get(url:string):any {
        return (<any>window).fetch(url, {
            headers: {
                'x-token': API.getInstance().token
            }
        });
    }

    public static post(url:string, data:any):any {
        return (<any>window).fetch(url, {
            method: 'post',
            headers: {
                'x-token': API.getInstance().token
            },
            body: data
        });
    }

    public static put(url:string, data:any):any {
        return (<any>window).fetch(url, {
            method: 'put',
            headers: {
                'x-token': API.getInstance().token
            },
            body: data
        });
    }

    get token():string {
        return this._token;
    }

}