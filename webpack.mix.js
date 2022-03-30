const mix = require('laravel-mix');

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

//SITE
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css');

mix.postCss('resources/assets/site/assets/css/bootstrap.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/meanmenu.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/boxicons.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/owl.carousel.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/owl.theme.default.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/magnific-popup.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/slick.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/slick-theme.min.css','public/site/css').version();
mix.postCss('resources/assets/site/assets/css/style.css', 'public/site/css').version();
mix.postCss('resources/assets/site/assets/css/responsive.css','public/site/css').version();

mix.js('resources/assets/site/assets/js/jquery-3.5.1.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/jquery.meanmenu.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/jquery.mixitup.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/jquery.ajaxchimp.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/jquery.magnific-popup.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/owl.carousel.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/slick.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/form-validator.min.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/contact-form-script.js','public/site/js').version();
mix.js('resources/assets/site/assets/js/custom.js','public/site/js').version();

//CMS
mix.postCss('resources/assets/cms/assets/css/app.min.css', 'public/cms/css').version();
mix.postCss('resources/assets/cms/assets/css/bootstrap.min.css', 'public/cms/css').version();
mix.postCss('resources/assets/cms/assets/css/icons.min.css', 'public/cms/css').version();
mix.postCss('resources/assets/cms/assets/css/preloader.min.css', 'public/cms/css').version();
mix.postCss('resources/assets/cms/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css', 'public/cms/libs/css').version();

mix.js('resources/assets/cms/assets/js/app.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/apexcharts.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/calendar.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/chartjs.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/coming-soon.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/dashboard.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/datatable-pages.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/echarts.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/email-editor.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/fontawesome.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/form-advanced.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/form-editor.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/form-mask.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/form-validation.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/form-wizard.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/gmaps.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/invoices-list.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/leaflet-map.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/leaflet-us-states.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/lightbox.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/materialdesign.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/notification.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/pass-addon.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/rangeslider.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/rating.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/session-timeout.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/sparklines.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/sweetalert.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/table-responsive.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/two-step-verification.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/validation.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/vector-maps.init.js', 'public/cms/js').version();
mix.js('resources/assets/cms/assets/js/pages/table-editable.int.js', 'public/cms/js').version();

mix.js('resources/assets/cms/assets/libs/jquery/jquery.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/bootstrap/js/bootstrap.bundle.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/metismenu/metisMenu.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/simplebar/simplebar.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/node-waves/waves.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/feather-icons/feather.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/pace-js/pace.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/table-edits/build/table-edits.min.js', 'public/cms/libs/js').version();
mix.js('resources/assets/cms/assets/libs/apexcharts/apexcharts.min.js', 'public/cms/libs/js').version();


mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});
