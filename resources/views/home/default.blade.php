@extends('app')
@section('content')
<style>
    #map {
        width: 950px;
        height: 700px;
    }
</style>
<script src="/sbadmin2/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>

    var misPuntos = <?php echo $marcadoresJson ?>;

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
</script>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-4">
            <h2>Mapa de noticias</h2>
        </div>
    </div>
    <div class="row"></div>
    <div class="row">
        <div class="col-md-2">
            <div>Menu</div>
        </div>
        <div class="col-md-10">
            <div id="map"></div>
        </div>
    </div>
</div>
@endsection