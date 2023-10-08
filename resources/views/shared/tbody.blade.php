<tbody>

    @foreach($productos as $key => $producto)

        <tr>
            <td>{{ $producto->id }}</td>
            <td>
                <div>
                    <img
                    {{-- Metodo llamado desde el Modelo Producto -> imagenURL() --}}
                    src="{{ $producto->imagenURL() }}"
                    alt="{{ $producto->nombrelimitarCaracteres() }}"
                    class="image__producto">

                    <span>{{ $producto->nombrelimitarCaracteres() }}</span>
                </div>
            </td>
            <td>{{ $producto->created_at->diffForHumans() }}</td>
            <td>
                <div class="btn-space">
                    <a
                    wire:navigate
                    href="{{ route('producto.show', $producto) }}"
                    class="btn btn-success"
                    title="Ver detalle">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a
                    wire:navigate 
                    href="{{ route('producto.editar', $producto) }}"
                    class="btn btn-primary"
                    title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button
                    wire:click="$dispatch('confirmarEliminarProducto', {{ $producto->id }} )"
                    class="btn btn-danger"
                    title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </td>
        </tr>

    @endforeach

</tbody>