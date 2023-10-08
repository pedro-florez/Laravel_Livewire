{{--
    Modal Categoria
    # Agregar la pripiedad wire:ignore.self para que no actualice el componenete y se cierre el modal automaticamente
--}}
<div
wire:ignore.self
class="modal fade"
id="modalAddCategoria"
data-bs-backdrop="static"
data-bs-keyboard="false"
tabindex="-1"
aria-labelledby="modalAddCategoriaLabel"
aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h1 class="modal-title fs-5" id="modalAddCategoriaLabel">
                    Agregar Categoria
                </h1>

                <button
                wire:click="closeModalAddCategoria()"
                type="button"
                class="btn-close"></button>

            </div>

            <form wire:submit.prevent="saveCategoria">

                <div class="modal-body">

                    <div class="mb-3">

                        <label for="inputNombreCategoria" class="form-label">
                            Nombre
                        </label>

                        <input
                        wire:model.live="nombreCategoria"
                        id="inputNombreCategoria"
                        type="text"
                        class="form-control @error('nombreCategoria') is-invalid @enderror"
                        placeholder="Ingresar nombre">

                        @error('nombreCategoria')
                            <div class="form-text text-danger"> {{ $message }} </div>
                        @enderror

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                    wire:click="closeModalAddCategoria()"
                    type="button"
                    class="btn btn-danger">
                        Cerrar
                    </button>

                    <button
                    type="submit"
                    class="btn btn-primary">
                        Guardar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>