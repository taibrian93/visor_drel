<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ruta</title>
    @include('adminlte::plugins', ['type' => 'css'])
    <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <h2>COLEGIO: {{ $college->nombreCentroEducativo }}</h2>
            </div>
        </div>
        @if($collegeRoutes->count() > 0)
            @foreach ($collegeRoutes as $collegeRoute)
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-teal">
                                <h3 class="card-title">
                                    {{ $collegeRoute->descripcion }}
                                </h3>
                            </div>
                            <div class="card-body">
                                
                                @foreach ($collegeRoute->trajectorie as $key => $trajectorie)
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Punto Partida</label>
                                                <p class="border border-secondary bg-light text-dark p-2 rounded text-justify">{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoPartida) }}</p>
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Punto Llegada</label>
                                                <p class="border border-secondary bg-light text-dark p-2 rounded text-justify">{{ Helper::getDescriptionPopulationCenter($trajectorie->puntoLlegada) }}</p>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Distacia</label>
                                                <p class="border border-secondary bg-light text-dark p-2 rounded text-justify">{{ $trajectorie->distancia }} km</p>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-hover mb-4">
                                        <tr class="bg-gray">
                                            <th>Tipo Transporte</th>
                                            <th>Costo</th>
                                        </tr>
                                        @if (sizeof($trajectorie->mobility) > 0)
                                            @foreach ($trajectorie->mobility as $mobility)
                                            
                                                    
                                            <tr>
                                                <td>{{ $mobility->typeTransportation->descripcion }}</td>
                                                <td>S/.{{ $mobility->costo }}</td>
                                            </tr>
                                                
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" class="text-center">No hay datos</td>
                                            </tr>
                                        @endif
                                        
                                    </table>
                                    @if (($collegeRoute->trajectorie->count()) - 1 == $key)
                                        
                                    @else
                                        <hr>
                                        
                                    @endif
                                @endforeach
                                
                                    
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <h2 class="text-danger">No hay rutas registradas en este colegio!</h2>
                </div>
            </div>
        @endif
        
        
    </div>
    <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}" defer></script>
    <script src="{{ mix('js/dashboard.js')}}"></script>
    @include('adminlte::plugins', ['type' => 'js'])
</body>
</html>