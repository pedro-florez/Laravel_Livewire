<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    

    <title>Laravel Livewire</title>    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    
    <link 
    href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script
    src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>

    <style>

        .label__custom,
        .label__custom_left {
            margin-top: 0.4rem;
            margin-right: 0.5rem;
        }

        .label__custom_left {
            margin-left: 0.5rem;
        }

        .image__producto {
            border-radius: 50px;
            height: 40px;
            width: 40px;
        }

        .btn__order {
            cursor: pointer;
        }

        .btn__order > i {
            padding-left: 5px;
            padding-right: 5px;
        }

        .iconOpacity {
            opacity: 0.3;
        }

    </style>

    @livewireStyles

</head>
<body>

    @include('layouts.header')

    {{-- @php($productos = \App\Models\Producto::all()) --}}

    {{-- Opcion #1 Para renderizar los componentes --}}
    {{-- @livewire(
        'productos', 
        [ 
            'titulo' => 'Renderizando Componente desde Opcion #1',
            'productos' => $productos
        ]
    ) --}}

    {{-- Opcion #2 Para renderizar los componentes --}}
    {{-- <livewire:productos 
    titulo="Renderizando Componente desde Opcion #2"
    :productos="$productos"
    /> --}}

    {{-- <livewire:productos> --}}

    <div class="container mt-4">

        {{-- Mostrar Alertas --}}
        @if( session('alert') )

            @include('shared.alert', [
                'data' => session('alert')
            ])
            
        @endif

        {{-- Renderizar los componentes Dinamicamente --}}
        {{ $slot }}

    </div>

    @livewireScripts    

    {{-- Incluir archivos js personalizados --}}
    @stack('js')

</body>
</html>
