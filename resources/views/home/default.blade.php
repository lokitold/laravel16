@extends('app')
@section('content')
<style>
    #map {
        width: 1150px;
        height: 700px;
    }
</style>
<script src="/sbadmin2/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
            center: new google.maps.LatLng(44.5403, -78.5463),
            zoom: 8,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
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
        <div class="col-md-12">
            <div id="map"></div>
        </div>
    </div>
</div>
@endsection