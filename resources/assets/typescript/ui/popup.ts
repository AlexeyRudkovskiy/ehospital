export class Popup {

    protected element:any;

    constructor (private content:string, private ajax:boolean = false, private config:any = {}) { /* empty */ }

    public show():Popup {
        var request = (<any>window).fetch(this.content, {
            credentials: 'same-origin'
        })
            .then(response => response.text())
            .then(response => this.onContentLoaded(response));

        return this;
    }

    private onContentLoaded(response:string):void {
        var popup = document.createElement('div');
        var content = document.createElement('div');
        popup.classList.add('popup');
        content.classList.add('content');
        popup.appendChild(content);

        content.innerHTML = response;

        var forms = content.querySelectorAll('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', this.onFormSubmited);
        }

        document.body.appendChild(popup);
        this.element = popup;
    }

    private onFormSubmited(e):void {
        e.preventDefault();

        var formData:any = new FormData((<any>this));
        var token = formData.get('_token');

        (<any>window).fetch((<any>this).getAttribute('action'), {
            method: (<any>this).getAttribute('method'),
            body: formData,
            credentials: 'same-origin',
            headers: {
                'Cookie': document.cookie
            }
        }).then(this.onFormResponse);
    }

    private onFormResponse():void {
        if (typeof this.config['close_after_form_submit'] !== "undefined" && this.config['close_after_form_submit'] == true) {
            this.element.parentElement.removeChild(this.element);
        }
    }

}