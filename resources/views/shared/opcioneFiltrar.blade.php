<div class="d-flex justify-content-between">

    <div class="d-flex justify-content-start">

        <label class="label__custom">
            Mostrar
        </label>

        <select
        wire:model="numPorPagina"
        class="form-select">
            
            @foreach ( $numerosDePaginas as $numero )

                <option 
                value="{{ $numero }}"
                {{ $numPorPagina == $numero ? 'selected' : '' }}>
                    {{ $numero }}
                </option>
                
            @endforeach

        </select>

        <label class="label__custom_left">
            registros
        </label>

    </div>

    <div class="d-flex justify-content-start">

        <label class="label__custom">
            Buscar
        </label>

        <input
        wire:model="buscar"
        type="text"
        class="form-control"
        placeholder="Filtrar producto">

    </div>            

</div>