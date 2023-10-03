//Import do Jquery
import jQuery from "jquery";
window.$ = jQuery;
window.jQuery = jQuery;

jQuery.expr[":"].icontains = function (a, i, m) {
    return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};

//Import das bibliotecas diversas
import "imagesloaded/imagesloaded.pkgd.js";
import "isotope-layout/dist/isotope.pkgd.js";
import "jquery-mask-plugin";
import "jquery-validation";
import "./modules/sweetAlert";
import { Modal } from "bootstrap";
const API_URL = `${window.location.origin}/api`;
window.API_URL = API_URL;
window.Modal = Modal;

/**
 * Cookies definition
 */

window.setCookie = (name, value) => {
    if (getCookie(name) != null) {
        deleteCookie(name);
    }
    var expires = "";
    var date = new Date();
    date.setTime(date.getTime() * 2);
    expires = "expires=" + date.toUTCString();

    document.cookie = `${name}=${value || ""}; ${expires}; path=/; domain=${
        location.hostname
    }`;
};

window.getCookie = (name) => {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
};

window.deleteCookie = (name) => {
    document.cookie = `${name}=; Max-Age=0; path=/; domain=${location.hostname}`;
};

/**
 * Ajax SETUP
 */
const CSRF = $('meta[name="csrf-token"]').attr("content");
const BEARER = `Bearer ${getCookie("_plainToken")}`;
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": CSRF,
        Authorization: BEARER,
    },
});

//Globalização da mascara de telefone
(window.SPMaskBehavior = function (val) {
    return val.replace(/\D/g, "").length === 11
        ? "(00) 00000-0000"
        : "(00) 0000-00009";
}),
    (window.spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        },
    });

/**
 * Instancia do Swiper
 */
import Swiper from "swiper/bundle";
import "swiper/css/bundle";

window.Swiper = Swiper;

/**
 * Importação do Moment.JS
 */
import "./modules/moment";

/**
 * Instancia do datetimepicker
 */
import "./modules/datetimepicker";

let deferredPrompt; // Permite mostrar o prompt de instalação do PWA
let setupButton;
//PWA instalation
jQuery(() => {
    window.addEventListener("beforeinstallprompt", (e) => {
        // Previne que o chrome >= 67 mostre o prompt automaticamente.
        e.preventDefault();
        // Salva o evento para ser chamado depois
        deferredPrompt = e;
        if (setupButton == undefined) {
            setupButton = document.getElementsByClassName("pwa-btn");
        }
    });
});

jQuery(() => {
    if (!window.matchMedia("(display-mode: standalone)").matches) {
        setTimeout(function () {
            $(".pwa-offcanvas").addClass("show");
            $(".pwa-backdrop").addClass("fade show");
        }, 1000);

        $(".pwa-btn").on("click", function () {
            //Se clicar em instalar
            $(".pwa-offcanvas").slideUp(500, function () {
                $(this).removeClass("show");
            });
            setTimeout(function () {
                // Mostra o prompt de instalação
                deferredPrompt.prompt();
                setupButton.disabled = true;
                //
                deferredPrompt.userChoice.then((choiceResult) => {
                    if (choiceResult.outcome === "accepted") {
                        console.log("PWA setup accepted");
                        // hide our user interface that shows our A2HS button
                        setupButton.style.display = "none";
                    } else {
                        console.log("PWA setup rejected");
                    }
                    deferredPrompt = null;
                });

                $(".pwa-backdrop").removeClass("show");
            }, 500);
        });

        $(".pwa-backdrop, .pwa-close").on("click", function () {
            $(".pwa-offcanvas").slideUp(500, function () {
                $(this).removeClass("show");
                $(".pwa-backdrop").removeClass("show");
            });

            return false;
        });
    }
});
