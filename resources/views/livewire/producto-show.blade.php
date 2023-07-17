<div>
    
    <h2> {{ $producto->nombre }} </h2>

    <p> {{ $producto->descripcion }} </p>

    <div>
        <img 
        src="{{ $producto->imagenURL() }}"
        class="img-thumbnail mb-2"
        alt="{{ $producto->nombre }}"
        width="400">        
    </div>

    <div>
        <b>Categoria:</b> {{ $producto->categoria->nombre }}
    </div>
    
    <small class="text-body-secondary">
        Creado el {{ $producto->created_at->format('d-m-Y') }}
    </small>

</div>
