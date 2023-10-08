<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Producto extends Model {

    use HasFactory;

    protected $table = "productos";

    /**
     ** Incializar valores por default
     */
    public function __construct( array $attributes = [] ) {

        parent::__construct( $attributes );

        $this->attributes['token'] = Str::random(10);
    }

    /**
     ** Deshabilidar Asignacion Masiva
     */
    protected $guarded = [];

    /**
     ** Mostrar la Propiedad token en la Url por el ID
     */
    public function getRouteKeyName() {
        return 'token';
    }

    /**
     ** Metodo Custom para limitar losCaracteres
     */
    public function nombrelimitarCaracteres() {

        $numValido = 20;

        $nombre = $this->nombre;

        $numeroCaracter = strlen( $nombre );

        if ( $numeroCaracter > $numValido ) {

            $nombre = substr( $nombre, 0, $numValido) . '...';
        }

        return $nombre;
    }

    /**
     ** Metodo Custom para Url de la Imagen
     */
    public function imagenURL() {

        if ( !empty($this->imagen) ) {
            
            $url = substr( $this->imagen, 0, 5);
    
            return $url != 'https'
                   ? asset('storage/'.$this->imagen)
                   : $this->imagen;
        }

        return $this->imagen;
    }

    /**
    ** Relacion del Producto con la Categoria
    */
    public function categoria() {
    
        return $this->belongsTo( Categoria::class );
    }
}