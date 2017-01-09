export class Nomenclature {

    private _name:string;

    private _id:number;

    private _units:any;

    constructor(name: string, id: number, units:any) {
        this._name = name;
        this._id = id;
        this._units = units;
    }

    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get id(): number {
        return this._id;
    }

    set id(value: number) {
        this._id = value;
    }

    get units(): any {
        return this._units;
    }

    set units(value: any) {
        this._units = value;
    }

}