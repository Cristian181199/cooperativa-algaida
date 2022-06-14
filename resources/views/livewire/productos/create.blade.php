<x-dialog-modal wire:model="openCreate">

    <x-slot name="title">
        Crear producto nuevo.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Denominacion del producto" />
            <x-input type="text" class="w-full" wire:model="denominacion" />
            @error('denominacion') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Imagen del suministro" />
            <x-input type="file" class="w-full" wire:model="imagen" />
            @error('imagen') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div>
            @if ($imagen)
                Vista previa de la imagen:
                <img src="{{ $imagen->temporaryUrl() }}">
            @endif
        </div>

        <div wire:loading wire:target="imagen">
            Cargando imagen...
        </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openCreate', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="save" wire:target="save, imagen" wire:loading.attr="disabled" class="ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300 disabled:opacity-25">
            Crear
        </button>

        <span wire:loading wire:target="save">
            Cargando...
        </span>
    </x-slot>

</x-dialog-modal>
