
<div>

    <h2>{{ $producto->exists ? 'Editar' : 'Agregar' }} Producto</h2>

    {{--
        * Evitar que se recargue la pantalla .prevent
        * Enviar el formulario al metodo "save" creado en la class ProductoForm
    --}}
    <form wire:submit.prevent="save">        

        <div class="mb-3">

            <label for="inputNombre" class="form-label">
                Nombre
            </label>

            <input
            wire:model.live.debounce.500ms="producto.nombre"
            id="inputNombre"
            type="text"
            class="form-control @error('producto.nombre') is-invalid @enderror"
            placeholder="Ingresar nombre">

            @error('producto.nombre')
                <div class="form-text text-danger"> {{ $message }} </div>
            @enderror

        </div>

        <div class="mb-3">

            <label for="inputSlug" class="form-label">
                Slug
            </label>

            <input
            wire:model.live="producto.slug"
            id="inputSlug"
            type="text"
            class="form-control @error('producto.slug') is-invalid @enderror"
            placeholder="Ingresar slug">

            @error('producto.slug')
                <div class="form-text text-danger"> {{ $message }} </div>
            @enderror

        </div>

        <div class="mb-3">

            <label
            class="form-label">
                Categoria
            </label>

            <div class="input-group">                

                <select
                wire:model.live="producto.categoria_id"
                class="form-select @error('producto.categoria_id') is-invalid @enderror">

                    <option selected>-Seleccionar-</option>

                    {{-- Mostar Categorias --}}
                    @foreach ( $categorias as $id => $nombre )

                        <option 
                        value="{{ $id }}"
                        {{ $id == $producto->categoria_id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>

                    @endforeach

                </select>

                {{-- Boton Modal Agregar Categoria --}}
                <button                
                title="Agregar Categoria"
                type="button"
                class="btn btn-secondary"
                data-bs-toggle="modal" 
                data-bs-target="#modalAddCategoria">
                    <i class="fas fa-plus fa-sm"></i>
                </button>

            </div>

            @error('producto.categoria_id')
                <div class="form-text text-danger"> {{ $message }} </div>
            @enderror

        </div>

        <div class="mb-3">

            <label
            for="textAreaDecripcion"
            class="form-label">
                Descripción
            </label>
            <textarea
            wire:model.live="producto.descripcion"
            id="textAreaDecripcion"
            class="form-control @error('producto.descripcion') is-invalid @enderror"
            rows="4"
            placeholder="Ingresar Descripción..."></textarea>

            @error('producto.descripcion')
                <div class="form-text text-danger"> {{ $message }} </div>
            @enderror

        </div>

        <div class="mb-3">

            <label for="inputImagen" class="form-label">
                {{ $producto->imagen ? 'Cambiar' : 'Subir' }}  imagen
            </label>

            <input
            wire:model.live="imagen"
            id="inputImagen"
            type="file"
            class="form-control @error('imagen') is-invalid @enderror">

            @error('imagen')
                <div class="form-text text-danger"> {{ $message }} </div>
            @enderror

            <div
            wire:loading.class="spinner-border text-primary"
            wire:target="imagen">
            </div>

            @if ( $imagen )

                {{-- Setear campos $set('imagen', null) --}}
                <button
                wire:click="$set('imagen', null)"
                class="btn btn-danger">Quitar imagen</button>

                <img
                src="{{ $imagen->temporaryUrl() }}"
                class="img-thumbnail mb-2 mt-2"
                width="400">

            @elseif( $producto->imagen )

                <img
                src="{{ $producto->imagenURL() }}"
                class="img-thumbnail mb-2"
                alt="{{ $producto->nombre }}"
                width="400">

            @endif

        </div>

        <button
        type="submit"
        class="btn btn-primary"
        {{ $btnSubmit ? 'disabled' : '' }}>
        {{ $producto->exists ? 'Actualizar': 'Guardar' }} Producto
        </button>

        {{-- Cargador --}}
        <div
        wire:loading.class="spinner-border text-primary"
        wire:target="save">
        </div>
        
    </form>

    {{-- Modal Agregar Categoria --}}
    @include('shared.modal')

</div>