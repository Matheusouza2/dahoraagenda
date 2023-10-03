const mix = require("laravel-mix");

const JSI = "resources/js";
const JSO = "public/js";
const CSSI = "resources/css";
const CSSO = "public/css";

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.autoload({
    jquery: ["$", "jQuery", "window.jQuery"],
});

mix.js(`${JSI}/app.js`, `${JSO}/modules.min.js`)
    .scripts(
        [
            `${JSI}/modules/bootstrap.bundle.min.js`,
            `${JSI}/modules/slideToggle.min.js`,
            `${JSI}/modules/tiny-slider.js`,
            `${JSI}/modules/internet-status.js`,
            `${JSI}/modules/venobox.min.js`,
            `${JSI}/modules/countdown.js`,
            `${JSI}/modules/rangeslider.min.js`,
            `${JSI}/modules/vanilla-dataTables.min.js`,
            `${JSI}/modules/index.js`,
            `${JSI}/modules/dark-rtl.js`,
            `${JSI}/modules/active.js`,
            `${JSI}/modules/formControl.js`,
            `${JSI}/modules/modalMessage.js`,
        ],
        `${JSO}/app.min.js`
    )
    .styles(`${CSSI}/style.css`, `${CSSO}/app.min.css`)
    .css(`${CSSI}/fontawesome.css`, `${CSSO}/icons.min.css`)
    .sass(`${CSSI}/sass.scss`, `${CSSO}/daterangepicker.css`)
    .version();

mix.browserSync("127.0.0.1:8000");
