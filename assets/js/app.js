const $ = require('jquery');

require('@fortawesome/fontawesome-free/js/all');
require('bootstrap/js/src');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
