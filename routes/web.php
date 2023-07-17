<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Inicio;
use App\Http\Livewire\ProductoIndex;
use App\Http\Livewire\ProductoForm;
use App\Http\Livewire\ProductoShow;

/*
* Web Routes
*/
Route::get( '/', Inicio::class )->name('inicio.index');

Route::get('/productos', ProductoIndex::class)->name('producto.index');

Route::get('/producto/crear', ProductoForm::class)->name('producto.crear');

Route::get('/producto/{producto}', ProductoShow::class)->name('producto.show');

Route::get('/producto/{producto}/editar', ProductoForm::class)->name('producto.editar');