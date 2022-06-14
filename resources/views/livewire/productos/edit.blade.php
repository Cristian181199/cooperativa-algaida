<x-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        Editar producto.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Denominacion del producto" />
            <x-input type="text" class="w-full" wire:model="producto.denominacion" />
            @error('producto.denominacion') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Imagen actual del suministro" />
            <img src="{{ Storage::disk('s3')->url($producto->imagen)}}" alt="{{ $producto->denominacion }}">
        </div>

        <div class="mb-4">
            <x-label value="Imagen nueva del suministro" />
            <x-input type="file" class="w-full" wire:model="imagen_nueva" />
            @error('imagen_nueva') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div>
            @if ($imagen_nueva)
                Vista previa de la imagen nueva:
                <img src="{{ $imagen_nueva->temporaryUrl() }}">
            @endif
        </div>

        <div wire:loading wire:target="imagen">
            Cargando imagen...
        </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openEdit', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="update" wire:target="update, imagen_nueva" wire:loading.attr="disabled" class="ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300">
            Editar
        </button>
    </x-slot>

</x-dialog-modal>
