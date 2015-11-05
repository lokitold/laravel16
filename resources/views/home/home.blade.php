@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mapa de noticias</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- GOogle APi JavaScript -->
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>

    function initialize() {
        var mapProp = {
            center:new google.maps.LatLng(51.508742,-0.120850),
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var latLng = new google.maps.LatLng(51.508742,-0.120850);
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });

        var latLng = new google.maps.LatLng(51.508742,-0.13);
        var marker = new google.maps.Marker({
            position: latLng,
            map: map
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
<div class="row">
    <div class="col-lg-10">
        <div id="googleMap" style="width:500px;height:380px;"></div>
    </div>
</div>
@endsection

