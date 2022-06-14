<x-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        Editar permiso.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Nombre del rol" />
            <x-input type="text" class="w-full" wire:model="permiso.name" />
            @error('permiso.name') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openEdit', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="update" wire:loading.attr="disabled" wire:target="update" class=" disabled:opacity-25 ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300">
            Editar
        </button>

        <span wire:loading wire:target="update">
            <p>Cargando...</p>
        </span>
    </x-slot>

</x-dialog-modal>
