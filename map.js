window.initMap = function () {
    var mapElement = document.getElementById('map');
    if(mapElement){
        var startLocation = mapElement.getAttribute('data-start');
        var endLocation = mapElement.getAttribute('data-end');

        console.log('Start Location: ', startLocation);
        console.log('End Location: ', endLocation);

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer();

        var mapOptions = {
            zoom: 7,
            center: { lat: 41.85, lng: -87.65 } // This is a default location (Chicago), you may want to make this dynamic based on your route.
        }

        var map = new google.maps.Map(mapElement, mapOptions);
        directionsRenderer.setMap(map);

        var request = {
            origin: startLocation,
            destination: endLocation,
            travelMode: 'DRIVING'
        };

        directionsService.route(request, function (result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }
    else{
        console.error("Map Element Not Found");
    }
}
