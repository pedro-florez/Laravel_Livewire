<div>

    <h2 class="mb-3">{{ $titulo }}</h2>    
    
    @include('shared.buttonsHeader')    

    @if( $mostrarProductos && $productos )

        <h4 class="text-center mt-3 mb-3">
            Listado de Productos
        </h4>

        @include('shared.opcioneFiltrar')

        <table class="table mt-2">

            @include('shared.thead')

            @include('shared.tbody')            

        </table>

        {{-- Mostar Paginador --}}
        {{ $productos->links('shared.pagination') }}

        @include('shared.eventDeleteJS')

    @endif    

</div>