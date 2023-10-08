<header>
    
    <nav class="navbar bg-dark border-bottom border-bottom-dark d-flex justify-content-center" data-bs-theme="dark">

        <a
        wire:navigate 
        class="navbar-brand" 
        href="{{ route('inicio.index') }}">Inicio</a>

        <a
        wire:navigate 
        class="navbar-brand" 
        href="{{ route('producto.index') }}">Productos</a>           

    </nav>

</header>
