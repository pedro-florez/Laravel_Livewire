{{-- Agregar el Script despues de cargar Livewire en la plantilla app --}}
@push('js')

    <script>

        // Escuchar Evento desde la propiedad $emit( nombre_del_evento )
        Livewire.on( 'confirmarEliminarProducto', productoId => {

            Swal.fire({
                title: `¿Está seguro(a) de eliminar el producto?`,
                text: '¡Si no lo está puede cancelar la acción!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Cancelar',
                confirmButtonText: 'Eliminar'
            }).then((result) => {

                if ( result.isConfirmed ) {

                    // Enviar Eventos al componente ProductoIndex
                    // emitTo('nombre_de_la_vista_blade', 'nombre_del_evento', parametro )
                    Livewire.emitTo('producto-index', 'eliminarProducto', productoId );
                }
            });
        });

        // Escuchar Evento Para Obtener Data del componente
        window.addEventListener( 'sweetalertProducto', e => {

            /**
             ** e.detail {
             **  'title'
            **  'text'
            **  'icon'
            ** }
            */
            Swal.fire( e.detail );
        });

    </script>

@endpush