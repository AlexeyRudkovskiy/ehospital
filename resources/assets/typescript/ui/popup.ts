export class Popup {

    protected static element:any = null;

    private onPopupLoaded:any = null;

    constructor (private content:string, private ajax:boolean = false, private config:any = {}) { /* empty */ }

    public show():Popup {
        if (Popup.element != null) {
            this.close();
        }

        if (this.ajax) {
            var request = (<any>window).fetch(this.content, {
                credentials: 'same-origin'
            })
                .then(response => response.text())
                .then(response => this.onContentLoaded(response));
        } else {
            this.onContentLoaded(this.content);
        }

        return this;
    }

    public close():void {
        if (Popup.element != null && Popup.element.parentElement != null) {
            Popup.element.parentElement.removeChild(Popup.element);
        }
    }

    setOnPopupLoaded(value: any): Popup {
        this.onPopupLoaded = value;
        return this;
    }

    private onContentLoaded(response:string):void {
        var popup = document.createElement('div');
        var content = document.createElement('div');
        popup.classList.add('popup');
        content.classList.add('content');
        popup.appendChild(content);

        content.innerHTML = response;

        if (typeof this.config.classes !== "undefined") {
            for (var i = 0; i < this.config.classes.length; i++) {
                content.classList.add(this.config.classes[i]);
            }

            var close:any = content.querySelectorAll('.close');
            for (var i = 0; i < close.length; i++) {
                close[i].addEventListener('click', this.close);
            }
        }

        var forms = content.querySelectorAll('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', this.onFormSubmited);
        }

        document.body.appendChild(popup);
        Popup.element = popup;

        if (this.onPopupLoaded != null) {
            this.onPopupLoaded.call(this, popup);
        }
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
            Popup.element.parentElement.removeChild(Popup.element);
        }
    }

}