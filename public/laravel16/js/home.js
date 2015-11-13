/**
 * Created by victor on 13/11/15.
 */

function initialize() {
    var mapCanvas = document.getElementById('map');

    var mapOptions = {
        center: new google.maps.LatLng(-12.0461738, -77.0299262),
        zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(mapCanvas, mapOptions)

    setGoogleMarkers(map, misPuntos);

}

var markers = Array();
var infowindowActivo = false;
function setGoogleMarkers(map, locations) {

    var marker;
    var infowindow = new google.maps.InfoWindow();

    for (i in locations){

        var marcador = locations[i];
        var myLatLng = new google.maps.LatLng(marcador.latitud, marcador.longitud);

        marker = new google.maps.Marker({
            position:myLatLng,
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i].content);
                infowindow.open(map, marker);
            }
        })(marker, i));

    }
}

google.maps.event.addDomListener(window, 'load', initialize);