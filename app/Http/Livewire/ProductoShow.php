<?php

namespace App\Http\Livewire;

use App\Models\Producto;
use Livewire\Component;

class ProductoShow extends Component {

    public Producto $producto;

    /**
    ** Obtener Producto por el Parametro ('producto') de la URL
    ** Opcion #1 desde el metodo mount( $nombre_del_paramtro )
    ** Opcion #2 desde request()->route('nombre_del_paramtro');
    ** Opcion #3 desde mount( Producto $producto );
    ** Opcion #4 sin utilizar el metodo mount() y 
    ** agregando el type de Dato a la variable $producto
    */
    /* public function mount( Producto $producto ) {
                
        //* $this->producto = Producto::findOrFail( $producto );   
        //* $producto = request()->route('producto');

        $this->producto = $producto;
    } */

    public function render() {
        
        # dd( request()->route('producto') );

        return view('livewire.producto-show');
    }
}
