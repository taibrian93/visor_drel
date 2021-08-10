<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de Usuarios
                </h3>

                <x-card-tools-search>

                </x-card-tools>
            </div>

            <div class="card-body table-responsive p-0">
                <x-table>
                    @slot('thead')
                        <tr>
                            <th>Nro.</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha Creacion</th>
                            <th style="width: 15%"></th>
                        </tr>
                    @endslot
                        
                    @slot('tbody')
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ (($page-1)*10)+($key+1) }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    {{-- <div class="btn-group"> --}}
                                        <a href="{{ route('user.edit', $user)}}" class="btn bg-lightblue btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                
                                        {{-- <a href="{{ route('user.show', $user)}}" class="btn bg-olive btn-sm" title="Consultar">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                
                                        <a href="#" class="btn btn-danger btn-sm delete" user="{{ $user->id }}" title="Eliminar">
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
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
