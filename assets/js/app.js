const $ = require('jquery');

require('@fortawesome/fontawesome-free/js/all');
require('bootstrap/js/src');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();

    $('.alert').on('closed.bs.alert', function () {
        var alertParent = $('.alerts');
        if(!alertParent.find('.alerts').length){
            alertParent.remove();
        }
    })
});

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
