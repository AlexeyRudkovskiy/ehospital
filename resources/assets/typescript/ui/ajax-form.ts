export class AjaxForm {

    constructor (private form:HTMLFormElement, private onFormSentEvent:any) {
        form.addEventListener('submit', function (e:any) {
            e.preventDefault();
            this.onFormSent();
        }.bind(this));
    }

    private onFormSent(): void {
        var url = this.form.action;
        var data = new FormData(this.form);
        var method = this.form.method;

        (<any>window).fetch(url, {
            method: method,
            credentials: 'same-origin',
            headers: {
                'x-token': (<any>window).token
            },
            body: data
        })
            .then(response => response.json())
            .then(response => this.onFormSentEvent.call(window, response));
    }

}