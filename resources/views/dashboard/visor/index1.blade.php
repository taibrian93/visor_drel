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

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary collapsed-card">
                <div class="card-header">
                    <h4 class="card-title">
                        Seleccionar por Provincia
                    </h4>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pb-0">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input id="checkPopulationCentersMaynas" type="checkbox" class="form-check-input checkPopulationCenter" value="1">
                                    <label for="checkPopulationCentersMaynas" class="form-check-label">Provincia Maynas</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersAltoAmazonas" type="checkbox" class="form-check-input checkPopulationCenter" value="2">
                                    <label for="checkPopulationCentersAltoAmazonas" class="form-check-label">Provincia Alto Amazonas</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersLoreto" type="checkbox" class="form-check-input checkPopulationCenter" value="3">
                                    <label for="checkPopulationCentersLoreto" class="form-check-label">Provincia Loreto</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersMariscal" type="checkbox" class="form-check-input checkPopulationCenter" value="4">
                                    <label for="checkPopulationCentersMariscal" class="form-check-label">Provincia Masriscal Ramon Castilla</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input id="checkPopulationCentersRequena" type="checkbox" class="form-check-input checkPopulationCenter" value="5">
                                    <label for="checkPopulationCentersRequena" class="form-check-label">Provincia Requena</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersUcayali" type="checkbox" class="form-check-input checkPopulationCenter" value="6">
                                    <label for="checkPopulationCentersUcayali" class="form-check-label">Provincia Ucayali</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersDatem" type="checkbox" class="form-check-input checkPopulationCenter" value="7">
                                    <label for="checkPopulationCentersDatem" class="form-check-label">Provincia Datem del Marañon</label>
                                </div>
                                <div class="form-check">
                                    <input id="checkPopulationCentersPutumayo" type="checkbox" class="form-check-input checkPopulationCenter" value="8">
                                    <label for="checkPopulationCentersPutumayo" class="form-check-label">Provincia Putumayo</label>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>

     
    </div>
    <div class="row">
        <div class="mt-1" id="visor">
    </div> --}}
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        #visor {
            width: 100%;
            height: 44em; 
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var minZoom = 6, maxZoom = 17, latitude = -3.7309081, longitude = -74.1528529, zoom = 6;
            var meta = $("meta[name='csrf-token']").attr("content");
            //var map = L.map('visor', { minZoom:minZoom, maxZoom:maxZoom }).setView([latitude, longitude], zoom);

            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            // }).addTo(map);

            // set up the map and remove the default zoomControl
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

            $(document).on('change', '.checkColleges', function() {
                
                let arrayCollege = [];
            
                let parametersMessage = ['Centro Educativo', 'Direccion', 'Cod. Local', 'Cod. Modular', 'Cod. Ubigeo'];
                $('.checkColleges').each(function(index){
                    if( $(this).is(':checked') ) { 
                        arrayCollege.push($(this).val());
                    }
                })
                let objCollege = Object.assign({}, arrayCollege);
                colleges.clearLayers();

                if(Object.keys(objCollege).length > 0){
                    
                    let url = '/dashboard/getColleges';
                    getVisorData(url, objCollege, colleges, imgCollege, parametersMessage);
                }
            });

            $(document).on('change', '.checkPopulationCenter', function() {
                
                let arrayPopulationCenter = [];
                let parametersMessage = ['Descripcion', 'Departamento', 'Provincia', 'Distrito', 'Cod. Ubigeo'];
                
                $('.checkPopulationCenter').each(function(index){
                    if( $(this).is(':checked') ) { 
                        arrayPopulationCenter.push($(this).val());
                    }
                })
                let objPopulationCenter = Object.assign({}, arrayPopulationCenter);
                populationCenters.clearLayers();

                if(Object.keys(objPopulationCenter).length > 0){
                    
                    let url = '/dashboard/populationCenters';
                    getVisorData(url, objPopulationCenter, populationCenters, imgPopulationCenter, parametersMessage);
                }
            });

            function getVisorData(url,object, layerGroup, img, pM){
                $.ajax({
                    method: "POST",
                    url: url,               
                    dataType: "json",
                    data: {
                        '_token' : meta,
                        'data' : object,
                    },
                    success: function(results) {
                        
                        if(results){
                            for (let i = 0; i < results.length; i++) {
                                for (let j = 0; j < results[i].length; j++) {
                                    L.marker([results[i][j]['x'], results[i][j]['y']],{icon: img}).bindPopup(`<b>${pM[0]}</b>: ${results[i][j]['message1']}<br><b>${pM[1]}</b>: ${results[i][j]['message2']}<br><b>${pM[2]}</b>: ${results[i][j]['message3']}<br><b>${pM[3]}</b>: ${results[i][j]['message4']}<br><b>${pM[4]}</b>: ${results[i][j]['message5']}<br>`).addTo(layerGroup);
                                }
                            }
                            layerGroup.addTo(map);
                        }
                    },
                    cache: false
                });
            }
            
        });
        

        
    </script>
@stop
