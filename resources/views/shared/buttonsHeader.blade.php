<div class="d-flex justify-content-between">

    <a
    href="{{ route('producto.crear') }}"
    class="btn btn-primary">
        Agregar Producto
    </a>

    <button
    wire:click="showTabla()"
    class="btn btn-secondary">

        {{ $mostrarProductos == true ? 'Ocultar' : 'Mostrar' }}
        Tabla Productos

    </button>

</div>