export class NomenclatureDay {

    private _from_day:string;

    private _until_day:string;

    private _amount:any;

    private _nomenclature_id:any;

    private _nomenclature:string;

    private _unit_id:any;

    private _unit:any;

    private _comment:any;

    constructor(
        from_day: string,
        until_day: string,
        amount: any,
        nomenclature_id: any,
        nomenclature:string,
        unit_id:string,
        unit:string,
        comment:string
    ) {
        this._from_day = from_day;
        this._until_day = until_day;
        this._amount = amount;
        this._nomenclature_id = nomenclature_id;
        this._nomenclature = nomenclature;
        this._unit_id = unit_id;
        this._unit = unit;
        this._comment = comment;
    }

    get from_day(): string {
        return this._from_day;
    }

    set from_day(value: string) {
        this._from_day = value;
    }

    get until_day(): string {
        return this._until_day;
    }

    set until_day(value: string) {
        this._until_day = value;
    }

    get amount(): number {
        return this._amount;
    }

    set amount(value: number) {
        this._amount = value;
    }

    get nomenclature_id(): number {
        return this._nomenclature_id;
    }

    set nomenclature_id(value: number) {
        this._nomenclature_id = value;
    }

    get nomenclature(): string {
        return this._nomenclature;
    }

    set nomenclature(value: string) {
        this._nomenclature = value;
    }

    get unit_id(): any {
        return this._unit_id;
    }

    set unit_id(value: any) {
        this._unit_id = value;
    }

    get unit(): any {
        return this._unit;
    }

    set unit(value: any) {
        this._unit = value;
    }

    get comment(): any {
        return this._comment;
    }

    set comment(value: any) {
        this._comment = value;
    }

}
