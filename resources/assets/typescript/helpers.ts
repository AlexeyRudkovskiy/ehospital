export function get (scope:any, variable:string) {
    return scope[variable];
}
export function set (scope:any, variable:string, value:any) {
    scope[variable] = value;
}