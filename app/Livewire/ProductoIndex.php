<?php

namespace App\Livewire;

use App\Models\Producto;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductoIndex extends Component {

    /**
     ** Trait para que no recargue la pantalla al paginar
     */
    use WithPagination;

    /**
     ** Las propiedades Publicas pueden ser accedidas desde la vista
     */
    public $titulo = 'Gestor de Productos';

    public $mostrarProductos = true;

    public $buscar = '';

    /**
     ** Numero de Registros por pagina
     */
    public $numPorPagina = 10;
    public $numerosDePaginas = [10,25,50,100];

    /**
     ** Propiedades Custom para Ordenar por campos en la tabla
     */
    public $sortField = 'created_at';
    public $sortDirection = 'desc';    

    /**
    ** Escuchar Eventos desde la Plantilla Blade u Otro Componente
    */
    #[On('eliminarProducto')]
    public function eliminarProducto( $producto_id ) {

        $producto = Producto::find( $producto_id );

        //* Validar si es un producto
        if ( $producto instanceof Producto ) {

            //* Eliminar la Imagen del Producto
            Storage::disk('public')->delete( $producto->imagen );

            //* Eliminar producto
            $producto->delete();

            /**
             ** Enviar Evento Alert Exito
            */
            $this->dispatch(
                'sweetalertProducto',
                payload : [
                    'title' => '¡Buen Trabajo!',
                    'text' => 'Producto eliminado con éxito.',
                    'icon' => 'success'
                ]
            );

        }else {

            /**
             ** Enviar Evento Alert Error
            */
            $this->dispatch(
                'sweetalertProducto',
                payload : [
                    'title' => 'Opsss',
                    'text' => 'Error al eliminar el producto.',
                    'icon' => 'error'
                ]
            );
        }
    }

    /**
     ** Opcion #1 Para Obtener Datos desde la DB
     ** public $productos;
     *
     ** El metodo mount() sirve como constructor de la clase
     ** public function mount() {

            ** Obtener productos desde la base de datos
     **     $this->productos = Producto::all();
     ** }
    */

    /**
     ** Resetear la pagina para realizar una busqueda
     ** Metodo updatingNombreDeLaPropiedad()
    */
    public function updatingBuscar() {

        $this->resetPage();
    }

    /**
    ** Metodo Custom Para Ordenar Campos
    */
    public function sortBy( $campo ) {

        $this->sortField = $campo;

        //* Validar el Tipo de Ordenamiento
        $this->sortField === $campo
            ? $this->sortDirection = ($this->sortDirection === 'asc') ? 'desc' : 'asc'
            : $this->sortDirection = 'asc';
    }

    /**
     ** Mostrar u Ocultar Tabla de productos
    */
    public function showTabla() {

        $accion = $this->mostrarProductos ? false : true;

        $this->mostrarProductos = $accion;
    }

    /**
     ** Renderizar el componente
     */
    public function render() {

        /* $productos = Producto::all(); */

        //* Opcion #2 Para Obtener Datos desde la DB
        $productos = Producto::where(
            'nombre',
            'like',
            "%{$this->buscar}%"
        )
        ->orderBy( $this->sortField,  $this->sortDirection )
        ->paginate( $this->numPorPagina );

        return view('livewire.producto-index', [
            'productos' => $productos
        ]);
    }
}
