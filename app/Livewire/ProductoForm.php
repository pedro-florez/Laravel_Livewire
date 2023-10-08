<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Producto;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class ProductoForm extends Component {

    /**
     * Trait WithFileUploads Se usa para subir archivo
     */
    use WithFileUploads;

    /**
     * @var \App\Models\Producto $producto
     ** Se Utiliza Modelo para crear y actulizar las sus propiedades
    */
    public Producto $producto;

    /**
     ** Para obtener la Data de la imagen sebe
     ** trabajar la propiedad por fuera del modelo
     */
    public $imagen;

    //** Propidad Para el modal agregar categoria
    public $nombreCategoria = '';
    public $isNombreCategoriaRequired = false;

    public $btnSubmit = false;

    /**
     ** En este cado de Utilizar Modelo Se debe Instanciar para poder crear producto
     */
    public function mount( Producto $producto ) {

        #$this->producto = new Producto;
        $this->producto = $producto;
    }

    /**
     ** Forma recomendada por Livewire de definir las Validaciones
     */
    /* protected $rules = [
        'nombre' => [
            'required',
            "regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
            'min:10'
        ],
        'descripcion' => ['required']
    ]; */

    /**
     ** Relizando las Validacion utilizando la propiedad del Modelo Producto
     ** Utilizar la Funcion rules() para obtener valor dentor de la rules
     */
    protected function rules() {

        return [
            'producto.nombre' => [
                'required',
                'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\\. ]+$/i',
                'min:10'
            ],
            'producto.slug' => [
                'required',
                'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\\-]+$/i',
                # Opcion 1
                Rule::unique('productos', 'slug')->ignore($this->producto)

                # Opcion 2
                #'unique:productos,slug,'.$this->producto->id
            ],
            'producto.categoria_id' => [
                'required',
                Rule::exists('categorias', 'id')
            ],
            'producto.descripcion' => [
                'required',
                'regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\\. ]+$/i',
                'max:250'
            ],
            'imagen' => [
                'nullable',
                Rule::when( $this->imagen, [
                    'image',
                    'max:2000'
                ])
            ],

            //* Reglas para crear nueva Categoria desde el modal
            'nombreCategoria' => [
                Rule::requiredIf( $this->isNombreCategoriaRequired ),
                'regex:/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\\. ]+$/i',
                'unique:categorias,nombre',
                'max:100'
            ]
        ];
    }

    /**
     ** Validacion en Tiempo Real con Livewire
     */
    public function updated( $propertyName ) {

        // dump( $propertyName );

        //* Validar en campo del formulario que este activo
        $this->validateOnly( $propertyName );
    }

    /**
    ** Obtener Valor de un campo en tiempo real
    */
    public function updatedProductoNombre( $nombre ) {

        //dump( $nombre );

        //* Agregar Slug Automatico
        $this->producto->slug = Str::slug( $nombre );
    }

    /**
     ** Escuchar Evento desde el archivo Producto.js
     */
    #[On('requiredNombreCategoria')]
    public function requiredNombreCategoria() {
        $this->isNombreCategoriaRequired = true;
    }

    /**
     ** Cerrar Modal Agregar Categoria
     */
    public function closeModalAddCategoria() {

        /**
         ** Ejecutar Funcion desde archivo JS
         */
        $this->js('cerrarModalAddCategoria()');

        /**
         ** Vaciar el campo nombre categoria
         */
        $this->nombreCategoria = '';

        /**
         ** Limpiar los erros de Validacion al Cerrar Modal
         */
        $this->clearValidation('nombreCategoria');

        $this->isNombreCategoriaRequired = false;
    }

    /**
    ** Guardar Categoria
    */
    public function saveCategoria() {

        /**
         ** Obtener la Validacion solo del Nombre de la Categoria
         ** Agregada en las rules
         */
        $this->validateOnly('nombreCategoria');

        //* Setear y Guardar Categoria
        $categoria = new Categoria;
        $categoria->nombre = trim($this->nombreCategoria);
        $categoria->save();

        //* Agregar el Id en el select de categorias
        $this->producto->categoria_id = $categoria->id;

        /**
         ** Cerrar Modal
         */
        $this->closeModalAddCategoria();
    }

    /**
     ** Guardar Producto
     */
    public function save() {
        
        /**
         ** Validar Formularios
        */
        //$data = $this->validate();
        $this->validate();

        /**
         ** Validar Imagen al Actualizar
        */
        //dd( $this->imagen );
        if ( !is_null($this->imagen) ) {

            //* Setear la URL de la imagen y Guardarla en el storage
            $this->producto->imagen = $this->imagen->store('/', 'public');
        }

        /**
         * TODO: Validar csrf_token del formulario
        */
        //dump( csrf_token() );

        //dump($this->producto);

        /**
         * Mensaje ( Guardado o Actualizado )
         */
        $accionSave = ( $this->producto->id == null )
                      ? 'guardado'
                      : 'actualizado';

        $mensaje = "Producto $accionSave con éxito.";

        /**
         ** Guardar desde el Modelo Directamente
        */
        $this->producto->save();

        //Producto::create( $data);

        /**
         ** Setear los datos
        */
        /* $producto = new Producto;

        $producto->nombre = $this->nombre;
        $producto->descripcion = $this->descripcion;

        $producto->save(); */

        /**
         ** Resetear el Formulario
        */
        #$this->reset();

        /**
         ** Aler de Exito
        */
        session()->flash( 'alert', [
            'tipo'    => 'success',
            'mensaje' => $mensaje
        ]);

        # Redirecionar
        $this->redirectRoute('producto.index');
    }

    /**
     ** Mostrar Formulario Producto
     */
    public function render() {

        /**
         ** Metodo pluck()
         ** Permite Obtener campos especificos de la tabla
         */
        return view('livewire.producto-form', [
            'categorias' => Categoria::pluck('nombre', 'id')
        ]);
    }
}