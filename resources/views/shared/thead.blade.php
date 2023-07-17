<thead>
    
    <tr>
        
        <th
        wire:click="sortBy('id')"
        class="btn__order">
            ID
            @include('shared.iconOrderField', [
                $sortField,
                $sortDirection,
                'campoActual' => 'id'
            ])
        </th>

        <th
        wire:click="sortBy('nombre')"
        class="btn__order">
            Nombre
            @include('shared.iconOrderField', [
                $sortField,
                $sortDirection,
                'campoActual' => 'nombre'
            ])
        </th>

        <th
        wire:click="sortBy('created_at')"
        class="btn__order">
            Creado
            @include('shared.iconOrderField', [
                $sortField,
                $sortDirection,
                'campoActual' => 'created_at'
            ])
        </th>

        <th>Acciones</th>

    </tr>

</thead>