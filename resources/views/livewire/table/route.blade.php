<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de Rutas
                </h3>

                <x-card-tools-search>

                </x-card-tools>
            </div>

            <div class="card-body table-responsive p-0">
                <x-table>
                    @slot('thead')
                        <tr>
                            <th>Nro.</th>
                            <th>Colegio</th>
                            <th>Codigo Modular</th>
                            <th>Ruta</th>
                            <th style="width: 15%"></th>
                        </tr>
                    @endslot
                        
                    @slot('tbody')
                        @foreach ($routes as $key => $route)
                            <tr>
                                <td>{{ (($page-1)*10)+($key+1) }}</td>
                                <td>{{ $route->college->nombreCentroEducativo }}</td>
                                <td>{{ $route->college->codigoModular }}</td>
                                <td>{{ $route->descripcion }}</td>
                                <td>
                                    {{-- <div class="btn-group"> --}}
                                        <a href="{{ route('route.edit', $route)}}" class="btn bg-lightblue btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a href="{{ route('route.show', $route)}}" class="btn bg-olive btn-sm" title="Consultar">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                        <a href="#" class="btn btn-danger btn-sm delete" route="{{ $route->id }}" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    {{-- </div> --}}
                                </td>
                            </tr>        
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {{ $routes->links() }}
            </div>
        </div>
    </div>
</div>
