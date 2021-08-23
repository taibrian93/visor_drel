<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Lista de Movilidad
        </h3>
    </div>

    <div class="card-body table-responsive p-0">
        <x-table>
            @slot('thead')
                <tr>
                    <th>Nro</th>
                    <th>Tipo Transporte</th>
                    <th>Costo</th>
                    <th style="width: 15%"></th>
                </tr>
            @endslot

            @slot('tbody')
                @foreach ($mobilities as $key => $mobility)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $mobility->typeTransportation->descripcion }}</td>
                        <td>S/. {{ $mobility->costo }}</td>
                        
                        <td>
                            <a href="{{ route('trajectorie.editMobility', ['trajectorie' => $trajectorie, 'mobility' => $mobility->id]) }}" class="btn bg-lightblue btn-sm" title="Transporte">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm delete" mobility="{{ $mobility->id }}" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table>
    </div>

    {{-- <div class="card-footer py-1 my-0">
        <p class="font-weight-light py-0 my-0">PP: Punto Partida</p>
        <p class="font-weight-light py-0 my-0">PL: Punto Llegada</p>
    </div> --}}
</div>