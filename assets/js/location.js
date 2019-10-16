const $ = require('jquery');
const loadGoogleMapsApi = require('load-google-maps-api')


$(document).ready(function() {
    $('.location-wrapper').each(function () {
        var _wrapper = $(this);
        var _lat = _wrapper.find('.latitude');
        var _lng = _wrapper.find('.longitude');
        var initialPosition = {
            lat: 33.995623,
            lng: -6.850023
        };
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(updatePosition);
            }
            return null;
        };
        function updatePosition(position) {
            if (!position) {
                return;
            }
            initialPosition.lat = position.coords.latitude;
            initialPosition.lng = position.coords.longitude;
        }
        function handleEvent(event) {
            initialPosition.lat = event.latLng.lat();
            initialPosition.lng = event.latLng.lng();

            _lat.val(initialPosition.lat);
            _lng.val(initialPosition.lng);
        }

        updatePosition(getLocation());

        loadGoogleMapsApi().then(function (googleMaps) {
            setInterval(function(){updatePosition(getLocation());}, 10000);
            var map = new googleMaps.Map(_wrapper.find('.map')[0], {
                center: initialPosition,
                zoom: 12
            });
            var marker = new google.maps.Marker({
                draggable: true,
                map: map,
                position: initialPosition,
                title: 'Click to zoom'
            });

            _lat.val(initialPosition.lat);
            _lng.val(initialPosition.lng);

            marker.addListener('drag', handleEvent);
            marker.addListener('dragend', handleEvent);
        }).catch(function (error) {
            _lat.val(initialPosition.lat);
            _lng.val(initialPosition.lng);
            console.error(error)
        });
    })
});
