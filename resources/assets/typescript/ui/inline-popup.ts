export class InlinePopup {

    protected static element:any = null;

    protected root:any;

    protected pageMargins:number = 15;

    protected onLoadedFunc:any = null;

    constructor (
        private target:any,
        private content:string,
        private ajax:boolean = false,
        private config:any = {}
    ) {
        if (typeof config['maxWidth'] === "undefined") {
            this.config['maxWidth'] = 300;
        }
    }

    public setOnLoadedEventListener(func:any):InlinePopup {
        this.onLoadedFunc = func;
        return this;
    }

    public show():InlinePopup {
        if (InlinePopup.element != null) {
            InlinePopup.element.parentElement.removeChild(InlinePopup.element);
        }

        if (this.ajax) {
            var request = (<any>window).fetch(this.content, {
                credentials: 'same-origin'
            })
                .then(response => response.text())
                .then(this.onContentLoaded.bind(this));
        }

        return this;
    }

    private onContentLoaded (response) {
        var offsetTop = this.target.offsetTop;
        var offsetLeft = this.target.offsetLeft;
        var offsetWidth = this.target.offsetWidth;
        var offsetHeight = this.target.offsetHeight;

        var popup = document.createElement('div');
        var popupContent = document.createElement('div');
        var popupClose = document.createElement('div');
        var popupTriangle = document.createElement('div');

        popup.classList.add('inline-popup');
        popupClose.classList.add('inline-popup-close');
        popupContent.classList.add('inline-popup-content');
        popupTriangle.classList.add('inline-popup-triangle');

        popup.appendChild(popupContent);
        popup.appendChild(popupClose);
        popup.appendChild(popupTriangle);

        popupContent.innerHTML = response;

        InlinePopup.element = popup;
        document.querySelector('.container .content').appendChild(popup);

        popup.style.top = "0px";
        popup.style.left = "0px";

        this.root = popupContent.firstChild;

        if (popup.offsetWidth > this.config.maxWidth) {
            var maxWidth = this.config.maxWidth;
            popup.style.width = maxWidth + 'px';
        }

        popup.style.top = (offsetTop + offsetHeight) + "px";
        var popupLeftPosition = offsetLeft - popup.offsetWidth / 2;
        popup.style.left = (popupLeftPosition) + "px";
        popupTriangle.style.left = (popup.offsetWidth / 2) + "px";
        popupTriangle.style.marginLeft = "17px";

        if (this.onLoadedFunc != null) {
            this.onLoadedFunc.call(window, this.root);
        }
    }

}