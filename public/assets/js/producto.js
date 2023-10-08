
function eliminarProducto() {

    // Escuchar Evento desde la Plantilla Blade
    Livewire.on('confirmarEliminarProducto', (productoId) => {

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

                // Enviar Eventos al componente en este ProductoIndex
                // Livewire.dispatch('nombre_event', parametros )
                Livewire.dispatch('eliminarProducto', { producto_id: productoId });
            }
        });
    });

    // Escuchar Evento Desde el Componente
    Livewire.on('sweetalertProducto', ({payload}) => {
        Swal.fire( payload );
    });
}

function cerrarModalAddCategoria() {

    const getModalAddCategoria = document.getElementById('modalAddCategoria');

    // Obtener Instacia del Modal Categoria Abierto
    var modalAddCategoria = bootstrap.Modal.getOrCreateInstance(getModalAddCategoria);

    // Cerrar Modal
    modalAddCategoria.hide();
}

function requiredNombreCategoria() {

    const modalCategoria = document.getElementById('modalAddCategoria');

    // Validar si Existe el modal    
    if ( modalCategoria != null ) {
        
        modalCategoria.addEventListener('show.bs.modal', function (e) {
            Livewire.dispatch('requiredNombreCategoria');
        });
    }        
}

/* Inicializar Eventos al Cargar la Pagina por primera vez
-------------------------------------------------- */
document.addEventListener('livewire:initialized', () => {
    eliminarProducto();
    requiredNombreCategoria();
});

/* Inicializar Eventos al cambiar de Pagina
-------------------------------------------------- */
document.addEventListener('livewire:navigated', () => {
    eliminarProducto();
    requiredNombreCategoria();
});