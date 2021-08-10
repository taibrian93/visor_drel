<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de Tipos de Transporte
                </h3>

                <x-card-tools-search>

                </x-card-tools>
            </div>

            <div class="card-body table-responsive p-0">
                <x-table>
                    @slot('thead')
                        <tr>
                            <th>Nro.</th>
                            <th>Descripción</th>
                            <th style="width: 15%"></th>
                        </tr>
                    @endslot
                        
                    @slot('tbody')
                        @foreach ($typeTransportations as $key => $typeTransportation)
                            <tr>
                                <td>{{ (($page-1)*10)+($key+1) }}</td>
                                <td>{{ $typeTransportation->descripcion }}</td>
                                <td>
                                    {{-- <div class="btn-group"> --}}
                                        <a href="{{ route('typeTransportation.edit', $typeTransportation)}}" class="btn bg-lightblue btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm delete" typeTransportation="{{ $typeTransportation->id }}" title="Eliminar">
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
                {{ $typeTransportations->links() }}
            </div>
        </div>
    </div>
</div>
