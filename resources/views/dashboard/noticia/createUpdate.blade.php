@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar Noticia </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-right"><a target='_blank' href="{!! $noticia->url !!}}">Acceder a Noticia</a></p>
                </div>

                @if($errors->has())
                    <div class='alert alert-danger'>
                        @foreach ($errors->all('<p>:message</p>') as $message)
                            {!! $message !!}
                        @endforeach
                    </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                @endif

                <div class="panel-body">
                    {!! Form::model($noticia,['route' => ['dashboard.noticia.update', $noticia->id],'method' => 'PUT']) !!}

                    <div class="form-group">
                        {!! Form::submit('Send', ["class" => "btn btn-success "]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('titulo', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::textarea('descripcion', null,
                                ['class'=>'form-control', 'placeholder'=>'Body', 'disabled' => 'disabled'])
                        !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('fecha_publicacion', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::text('url', null, ["class" => "form-control" , 'disabled' => 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('longitudlabel', 'Longitud') !!}
                        {!! Form::Number('longitud', null, ["class" => "form-control" , 'type' => "number",'step'=>"any" ,'id' => 'input-longitud']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('latitudlabel', 'Latitud') !!}
                        {!! Form::Number('latitud', null, ["class" => "form-control" , 'type' => "number",'step'=>"any",'id' => 'input-latitud']) !!}
                    </div>

                    <!-- test varios locaciones por noticias -->
                    <div class="panel-body">
                    @foreach($noticia->locations as $location)
                        <div class="form-group">
                        {!! Form::text('location['.$location->id.'][longitud]',$location->longitud, ["class" => "form-control" , 'type' => "number",'step'=>"any"]) !!}
                        {!! Form::text('location['.$location->id.'][latitud]',$location->latitud,["class" => "form-control" , 'type' => "number",'step'=>"any"]) !!}
                        </div>
                    @endforeach
                    </div>
                    <!-- FIN test varios locaciones por noticias-->


                    <div class="panel-body ">
                        <input id="pac-input" class="form-control" type="text" placeholder="Buscar...">
                        <div id="map" style="height: 620px"></div>
                    </div>

                    <div class="form-group pull-right">
                        <p class="text-left"><a href="{!! $noticia->url !!}}" target="_blank">Acceder a Noticia</a></p>
                    </div>

                     <div class="form-group">
                        {!! Form::label('estado', 'Estado') !!}
                        {!! Form::select('status', ['' => '', 0 => 'Sin Editar', 1 => 'Editado', 2 => 'Rechazado'], null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Send', ["class" => "btn btn-success "]) !!}
                    </div>



                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>

        function initAutocomplete() {
            var latLng = {
                        lat: <?php echo $noticia->latitud ? $noticia->latitud : '-12.0461738' ?>,
                        lng: <?php echo $noticia->longitud ? $noticia->longitud : '-77.0299262' ?>
              },
                    map = new google.maps.Map(document.getElementById('map'), {
                        center: latLng,
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }),
                    marker = new google.maps.Marker({
                        position: latLng,
                        draggable: true,
                        map: map,
                        title: 'Arrastrar para ubicar posición'
                    }),
                    setData = function (){
                        document.getElementById('input-longitud').value = marker.position.lng();
                        document.getElementById('input-latitud').value = marker.position.lat();
                        $('select[name=\'status\'] > option[value="1"]').attr('selected', 'selected')
                    },
                    input = document.getElementById('pac-input'),
                    searchBox = new google.maps.places.SearchBox(input);

            map.addListener('click', function(e) {
                marker.setPosition(e.latLng);
                setData();
            });
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            marker.addListener('dragend', function(){
                setData();
            });

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                //del array, cogemos solo el primero
                marker.setPosition(places[0].geometry.location);
                marker.setTitle(places[0].name);
                map.panTo(places[0].geometry.location);
                setData();
            });
        }
    </script>
    <script src="/sbadmin2/bower_components/jquery/dist/jquery.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2g6-YR2236S6r66mOjlNYE-eoiVvETvw&signed_in=true&libraries=places&callback=initAutocomplete"></script>
@endsection

