<?php

namespace App\Livewire;

use Livewire\Component;

class Inicio extends Component {

    public string $titulo = 'Bienvenido';

    public string $autor = 'Pedro Florez';

    public string $mensaje = '';

    public function render() {

        return view('livewire.inicio');
    }
}
