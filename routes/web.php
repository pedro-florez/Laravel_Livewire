<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Inicio;
use App\Livewire\ProductoIndex;
use App\Livewire\ProductoForm;
use App\Livewire\ProductoShow;

/*
* Web Routes
*/
Route::get( '/', Inicio::class )->name('inicio.index');

Route::get('/productos', ProductoIndex::class)->name('producto.index');

Route::get('/producto/crear', ProductoForm::class)->name('producto.crear');

Route::get('/producto/{producto}', ProductoShow::class)->name('producto.show');

Route::get('/producto/editar/{producto}', ProductoForm::class)->name('producto.editar');