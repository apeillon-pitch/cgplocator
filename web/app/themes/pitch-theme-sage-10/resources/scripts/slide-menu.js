/*eslint-disable */
! function(t) {
    "use strict";

    function e(t, e) {
        for (var s in e) {
            e.hasOwnProperty(s) && (t[s] = e[s]);
        }
        return t
    }

    function s(t, e) {
        for (var s = 0; s < t.length; s++) {
            var i = t[s];
            e(i)
        }
    }

    function i(t) {
        this.options = e({}, this.options), e(this.options, t), this._init()
    }
    i.prototype.options = {
        wrapper: "#o-wrapper",
        type: "slide-left",
        menuOpenerClass: ".c-button",
        maskId: "#c-mask"
    }, i.prototype._init = function() {
        this.body = document.body, this.wrapper = document.querySelector(this.options.wrapper), this.mask = document.querySelector(this.options.maskId), this.menu = document.querySelector("#c-menu--" + this.options.type), this.closeBtn = this.menu.querySelector(".c-menu__close"), this.menuOpeners = document.querySelectorAll(this.options.menuOpenerClass), this._initEvents()
    }, i.prototype._initEvents = function() {
        this.closeBtn.addEventListener("click", function(t) {
            t.preventDefault(), this.close()
        }.bind(this)), this.mask.addEventListener("click", function(t) {
            t.preventDefault(), this.close()
        }.bind(this))
    }, i.prototype.open = function() {
        this.body.classList.add("has-active-menu"), this.wrapper.classList.add("has-" + this.options.type), this.menu.classList.add("is-active"), this.mask.classList.add("is-active"), this.disableMenuOpeners()
    }, i.prototype.close = function() {
        this.body.classList.remove("has-active-menu"), this.wrapper.classList.remove("has-" + this.options.type), this.menu.classList.remove("is-active"), this.mask.classList.remove("is-active"), this.enableMenuOpeners()
    }, i.prototype.disableMenuOpeners = function() {
        s(this.menuOpeners, function(t) {
            t.disabled = !0
        })
    }, i.prototype.enableMenuOpeners = function() {
        s(this.menuOpeners, function(t) {
            t.disabled = !1
        })
    }, t.Menu = i
}(window);

var slideRight = new Menu({
  wrapper: '#o-wrapper',
  type: 'slide-right',
  menuOpenerClass: '.c-button',
  maskId: '#c-mask',
});

var slideRightBtn = document.querySelector('#c-button--slide-right');

slideRightBtn?.addEventListener('click', function (e) {
  e.preventDefault;
  slideRight.open();
});
