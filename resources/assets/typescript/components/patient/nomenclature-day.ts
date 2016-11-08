export class NomenclatureDay {

    private _day:string;

    private _amount:number;

    private _nomenclature_id:number;

    constructor(day: string, amount: number, nomenclature_id: number) {
        this._day = day;
        this._amount = amount;
        this._nomenclature_id = nomenclature_id;
    }

    get day(): string {
        return this._day;
    }

    set day(value: string) {
        this._day = value;
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

}