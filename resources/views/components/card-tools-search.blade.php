<div class="card-tools">
    <div class="input-group input-group-sm" style="width: 30vw;">
        <input wire:keydown="cleanPage" wire:model="search" type="text" name="table_search" class="form-control float-right" placeholder="Buscar...">

        <div class="input-group-append">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
            {{-- <button type="submit" class="btn btn-default">
            
            </button> --}}
        </div>
    </div>
</div>