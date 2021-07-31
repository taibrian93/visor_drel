<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de Distritos
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
                            <th>Codigo Ubigeo</th>
                            <th style="width: 15%"></th>
                        </tr>
                    @endslot
                        
                    @slot('tbody')
                        @foreach ($districts as $key => $district)
                            <tr>
                                <td>{{ (($page-1)*10)+($key+1) }}</td>
                                <td>{{ $district->descripcion }}</td>
                                <td>{{ $district->codigoUbigeo }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('district.edit', $district)}}" class="btn bg-lightblue btn-sm">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                
                                        <a href="{{ route('district.show', $district)}}" class="btn bg-olive btn-sm">
                                            <i class="fas fa-eye"></i>
                                            Consultar
                                        </a>
                
                                        <a href="#" class="btn btn-danger btn-sm delete" district="{{ $district->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>        
                        @endforeach
                    @endslot
                </x-table>
            </div>

            <div class="card-footer d-flex justify-content-end">
                {{ $districts->links() }}
            </div>
        </div>
    </div>
</div>
