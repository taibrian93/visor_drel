@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    {{-- <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Inicio</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard"> Inicio</a></li>
                <li class="breadcrumb-item active"> Visor</li>
            </ol>
        </div>
    </div> --}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12 px-0">
            <div class="card collapsed-card pb-0 ">
                <div class="card-header py-0 mx-0 bg-gray">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="form-group text-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="maynas" value="1601" checked="checked">
                            <label class="form-check-label" for="maynas">MAYNAS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="altoamazonas" value="1602">
                            <label class="form-check-label" for="altoamazonas">ALTO AMAZONAS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="loreto" value="1603">
                            <label class="form-check-label" for="loreto">LORETO</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="mariscal" value="1604">
                            <label class="form-check-label" for="mariscal">MARISCAL RAMÓN CASTILLA</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="requena" value="1605">
                            <label class="form-check-label" for="requena">REQUENA</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="ucayali" value="1606">
                            <label class="form-check-label" for="ucayali">UCAYALI</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="datem" value="1607">
                            <label class="form-check-label" for="datem">DATEM DEL MARAÑÓN</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input provinces" type="radio" name="provincia" id="putumayo" value="1608">
                            <label class="form-check-label" for="putumayo">PUTUMAYO</label>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        
                          
                        <div class="input-group">
                            
                            <div class="input-group-prepend filtro">
                                <select class="form-control searchFilter">
                                    <option value="1">Nombre Colegio</option>
                                    <option value="2">Código Modular</option>
                                    <option value="3">Código Local</option>
                                </select>
                            </div>
                    
                            <input type="text" class="form-control searchInput" />
                    
                            <div class="input-group-append btnFiltro">
                                <button class="btn btn-success searchCollege" type="button">Buscar</button>
                                <button class="btn btn-danger deleteResultSeacrh" type="button" title="Eliminar Busqueda" disabled>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                    
                        </div>

                    </div>
                    
                    
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="my-0" id="visor">
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="mt-1" id="visor">
        </div>
        
    </div> --}}
    
    
    
        
@stop

@section('css')
    <style>
        #visor {
            width: 100%;
            height: 70em;
        }
        .row {
            margin-right: -14.5px;
            margin-left: -13.5px;
        }
        .card{
            border-radius: 0;
            margin-bottom: 0.1%;
        }
        .card-header {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .fa-plus {
            font-weight: 950;
            color: white;
        }
        .navbar{
            padding: 0;
        }
        .card-body {
            padding: 0.35rem;
        }
        .form-group {
            margin-bottom: 0.1rem;
        }
        .my-label {
            min-width: 14em;
            /* left: -30px; */
            text-align: center;
            min-height: 1.2em;
            border: 1px solid red;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var minZoom = 6, maxZoom = 17, latitude = -4.6122106, longitude = -75.6017193, zoom = 6.78;
            var meta = $("meta[name='csrf-token']").attr("content");
            var map = L.map('visor', {
                zoomControl: false,
                preferCanvas: true,
            });

            map.setView([latitude, longitude], zoom);
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                minZoom:minZoom,
                maxZoom:maxZoom
            }).addTo(map);
            
            var imgCollege = L.icon({
                iconUrl: '/img/colegio.png',
                iconSize:     [20, 20], // size of the icon
                iconAnchor:   [16, 20], // point of the icon which will correspond to marker's location
                popupAnchor:  [-12, -11] // point from which the popup should open relative to the iconAnchor
            });
            var imgPopulationCenter = L.icon({
                iconUrl: '/img/centro.png',
                iconSize:     [15, 18], // size of the icon
                //iconAnchor:   [26, 26], // point of the icon which will correspond to marker's location
                popupAnchor:  [-12, -11] // point from which the popup should open relative to the iconAnchor
            });
            // custom zoom bar control that includes a Zoom Home function
            L.Control.zoomHome = L.Control.extend({
                options: {
                    position: 'topright',
                    zoomInText: '+',
                    zoomInTitle: 'Zoom in',
                    zoomOutText: '-',
                    zoomOutTitle: 'Zoom out',
                    zoomHomeText: '<i class="fa fa-home" style="line-height:1.65;"></i>',
                    zoomHomeTitle: 'Zoom home'
                },

                onAdd: function (map) {
                    var controlName = 'gin-control-zoom',
                        container = L.DomUtil.create('div', controlName + ' leaflet-bar'),
                        options = this.options;

                    this._zoomInButton = this._createButton(options.zoomInText, options.zoomInTitle,
                    controlName + '-in', container, this._zoomIn);
                    this._zoomHomeButton = this._createButton(options.zoomHomeText, options.zoomHomeTitle,
                    controlName + '-home', container, this._zoomHome);
                    this._zoomOutButton = this._createButton(options.zoomOutText, options.zoomOutTitle,
                    controlName + '-out', container, this._zoomOut);

                    this._updateDisabled();
                    map.on('zoomend zoomlevelschange', this._updateDisabled, this);

                    return container;
                },

                onRemove: function (map) {
                    map.off('zoomend zoomlevelschange', this._updateDisabled, this);
                },

                _zoomIn: function (e) {
                    this._map.zoomIn(e.shiftKey ? 3 : 1);
                },

                _zoomOut: function (e) {
                    this._map.zoomOut(e.shiftKey ? 3 : 1);
                },

                _zoomHome: function (e) {
                    map.setView([latitude, longitude], zoom);
                },

                _createButton: function (html, title, className, container, fn) {
                    var link = L.DomUtil.create('a', className, container);
                    link.innerHTML = html;
                    link.href = '#';
                    link.title = title;

                    L.DomEvent.on(link, 'mousedown dblclick', L.DomEvent.stopPropagation)
                        .on(link, 'click', L.DomEvent.stop)
                        .on(link, 'click', fn, this)
                        .on(link, 'click', this._refocusOnMap, this);

                    return link;
                },

                _updateDisabled: function () {
                    var map = this._map,
                        className = 'leaflet-disabled';

                    L.DomUtil.removeClass(this._zoomInButton, className);
                    L.DomUtil.removeClass(this._zoomOutButton, className);

                    if (map._zoom === map.getMinZoom()) {
                        L.DomUtil.addClass(this._zoomOutButton, className);
                    }
                    if (map._zoom === map.getMaxZoom()) {
                        L.DomUtil.addClass(this._zoomInButton, className);
                    }
                }
            });
            // add the new control to the map
            var zoomHome = new L.Control.zoomHome();
            zoomHome.addTo(map);

            var colleges = L.layerGroup();
            var populationCenters = L.layerGroup();

            $(document).on('click', '.deleteResultSeacrh',function() {
                $('.searchInput').val('');
                $('.deleteResultSeacrh').prop('disabled', true);
                colleges.clearLayers();
                populationCenters.clearLayers();
                map.setView([latitude, longitude], zoom);
            })
            var lat;
            var long;
            $(document).on('click', '.searchCollege', function () {
                var idProvince = $("input[name='provincia']:checked").val();
                var inputSearch = $('.searchInput').val();
                var dataFilter = $('.searchFilter').val();
                var url = window.location.protocol + '//' + window.location.host +'/dashboard/getCollege';
                let pM = ['Centro Educativo', 'Direccion', 'Cod. Local', 'Cod. Modular', 'Cod. Ubigeo'];
                //parameters message Population Center
                let pMPC = ['Centro Poblado'];
                if(inputSearch.length > 1) {
                    $.ajax({
                        method: "POST",
                        url: url,               
                        dataType: "json",
                        data: {
                            '_token': meta,
                            'idProvince': idProvince,
                            'filter': dataFilter,
                            'val': inputSearch,
                        },
                        success: function(results) {
                            //console.log(results);
                            if(dataFilter == 1 || dataFilter == 3){
                                if(results.length > 0){
                                    
                                    colleges.clearLayers();
                                    populationCenters.clearLayers();
                                    
                                    $('.deleteResultSeacrh').prop('disabled', false);
                                    for (let i = 0; i < results.length; i++) {
                                        L.marker({
                                            icon: L.divIcon({
                                                html: "Null Island",
                                                className: 'text-below-marker',
                                            })  
                                        });
                                        var url = window.location.origin+'/dashboard/';
                                        var marker = L.marker([results[i]['x'], results[i]['y']],{icon: imgCollege}).bindPopup(`<b>${pM[0]}</b>: ${results[i]['message1']}<br><b>${pM[1]}</b>: ${results[i]['message2']}<br><b>${pM[2]}</b>: ${results[i]['message3']}<br><b>${pM[3]}</b>: ${results[i]['message4']}<br><b>${pM[4]}</b>: ${results[i]['message5']}<br><b>Enlace</b>: <a href="${url}${results[i]['id']}/route" target="_blank">${results[i]['message1']}</a>`).addTo(colleges);
                                        var markerPC = L.marker([results[i]['x_populationCenter'], results[i]['y_populationCenter']],{icon: imgPopulationCenter}).bindPopup(`<b>${pMPC[0]}</b>: ${results[i]['centroPoblado']}`).addTo(populationCenters);
                                        
                                        if(results.length == i + 1) {
                                            lat = results[i]['x'].substring(0,4);
                                            long = results[i]['y'].substring(0,4);
                                        }
                                    }

                                    colleges.addTo(map);
                                    populationCenters.addTo(map);
                                    map.setView([lat, long], 8.0);
                                    
                                } else {
                                    Swal.fire({
                                        text: "No se encontró este registro en la base de datos",
                                        icon: 'info',
                                        confirmButtonColor: '#3085d6',
                                    })
                                }
                            } else if(dataFilter == 2) {
                                if(results.length == 0) {
                                    Swal.fire({
                                        text: "No se encontró este Centro Educativo en la provincia seleccionada",
                                        icon: 'info',
                                        confirmButtonColor: '#3085d6',
                                    })
                                } else {
                                    console.log(results);
                                    var array = [];
                                    colleges.clearLayers();
                                    populationCenters.clearLayers();
                                    
                                    $('.deleteResultSeacrh').prop('disabled', false);
                                    for (let i = 0; i < results.routes.length; i++) {
                                        for (let j = 0; j < results.routes[i].length; j++) {
                                            var url = window.location.origin+'/dashboard/';
                    
                                            var markerPC_PuntoPartida = L.marker([results.routes[i][j]['x_puntoPartida'], results.routes[i][j]['y_puntoPartida']],{icon: imgPopulationCenter}).bindPopup(`<b>Centro Poblado</b>: ${results.routes[i][j]['centro_poblado_PP']}`).addTo(populationCenters);
                                        
                                            array.push([ results.routes[i][j]['x_puntoPartida'],  results.routes[i][j]['y_puntoPartida']]);
                                        }

                                    }
                                    var url = window.location.origin+'/dashboard/';
                                    array.push([results['x_populationCenter'], results['y_populationCenter']]);
                                    console.log(array);
                                    var marker = L.marker([results['x'], results['y']],{icon: imgCollege}).bindPopup(`<b>${pM[0]}</b>: ${results['message1']}<br><b>${pM[1]}</b>: ${results['message2']}<br><b>${pM[2]}</b>: ${results['message3']}<br><b>${pM[3]}</b>: ${results['message4']}<br><b>${pM[4]}</b>: ${results['message5']}<br><b>Enlace</b>: <a href="${url}${results['id']}/route" target="_blank">${results['message1']}</a>`).addTo(colleges);
                                    var markerPC_DFinal = L.marker([results['x_populationCenter'], results['y_populationCenter']],{icon: imgPopulationCenter}).bindPopup(`<b>${pMPC[0]}</b>: ${results['centroPoblado']}`).addTo(populationCenters)
                                    lat = results['x'].substring(0,4);
                                    long = results['y'].substring(0,4);
                                    colleges.addTo(map);
                                    populationCenters.addTo(map);
                                    
                                    var polyline = L.polyline(array, {color: 'red'}).addTo(map);
                                    
                                    map.setView([lat, long], 8.0);
                                }
                                
                            }
                            
                        },
                        cache: false
                    });
                } else {
                    Swal.fire({
                                    
                        text: "Tu criterio de busqueda debe tener al menos 2 caracteres!",
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        
                    })
                }
                
            });
            
        });
        

        
    </script>
@stop
