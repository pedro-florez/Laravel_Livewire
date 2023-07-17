<div>
    <h2>{{ $titulo }}</h2>

    <div class="mt-3"> 

        <p> 
            <b>Autor:</b> 
            {{ $autor }}
        </p>

    </div>

    <div class="mb-3">
        
        <label class="form-label">
            <b>Mensaje:</b>
        </label>

        {{-- wire:model Para cambia el valor de la propiedad "categoria" --}}
        <textarea
        wire:model="mensaje"
        type="text"
        class="form-control"
        placeholder="Ingresar mensaje...">
        </textarea>        

    </div>

    <div class="mb-3">

        <b>Mensaje en vivo:</b>

        <p>{{ $mensaje }} </p>

    </div>

</div>
