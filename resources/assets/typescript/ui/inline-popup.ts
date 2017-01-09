export class InlinePopup {

    protected static element:any = null;

    protected root:any;

    protected pageMargins:number = 15;

    protected onLoadedFunc:any = null;

    protected onCloseFunc:any = null;

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

    public setOnCloseEventListener(func:any):InlinePopup {
        this.onCloseFunc = func;
        return this;
    }

    public show():InlinePopup {
        if (InlinePopup.element != null && InlinePopup.element.parentElement != null) {
            this.close();
        }

        if (this.ajax) {
            var request = (<any>window).fetch(this.content, {
                credentials: 'same-origin',
                headers: {
                    token: (<any>window).token
                }
            })
                .then(response => response.text())
                .then(this.onContentLoaded.bind(this));
        }

        return this;
    }

    public close():void {
        if (InlinePopup.element != null && InlinePopup.element.parentElement != null) {
            InlinePopup.element.parentElement.removeChild(InlinePopup.element);
            //document.removeEventListener('click', this.onDocumentMouseClicked, true);

            if (this.onCloseFunc != null) {
                this.onCloseFunc.call(window);
            }
        }
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

        this.root = popupContent;

        if (popup.offsetWidth > this.config.maxWidth) {
            var maxWidth = this.config.maxWidth;
            popup.style.width = maxWidth + 'px';
        }

        popup.style.top = (offsetTop + offsetHeight) + "px";
        var popupLeftPosition = offsetLeft - popup.offsetWidth / 2;

        /*
         * Отступ от правой границы
         * Добавляет отступ что бы окно выглядело красивее
         */
        var popupRightWindowBorderOffset = 25;
        var triangleOffset = 17;
        if (popupLeftPosition + popup.offsetWidth > window.innerWidth - popupRightWindowBorderOffset) {
            popupLeftPosition = window.innerWidth - popup.offsetWidth - popupRightWindowBorderOffset;
            triangleOffset = 13;
        } else {
            popupLeftPosition += popupRightWindowBorderOffset;
        }

        popup.style.left = (popupLeftPosition) + 'px';

        var triangleDiff = Math.abs(popupLeftPosition - offsetLeft);

        popupTriangle.style.left = (triangleDiff) + "px";
        popupTriangle.style.marginLeft = (triangleOffset) + "px";

        if (this.onLoadedFunc != null) {
            this.onLoadedFunc.call(window, this.root, this);
        }

        (<any>document).onclick = this.onDocumentMouseClicked.bind(this);
    }

    private onDocumentMouseClicked(e):void {
        var target = e.target;
        var popup = this.root.parentElement;
        var inTarget = false;
        while (target !== document) {
            if (target === popup) {
                inTarget = true;
                break;
            }
            if (target.tagName.toLowerCase().indexOf('body') !== 0) {
                target = target.parentElement;
            } else {
                break;
            }
        }

        if (!inTarget) {
            this.close();
        }
    }

}
