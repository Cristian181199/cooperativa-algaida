<x-dialog-modal wire:model="openCreate">

    <x-slot name="title">
        Crear un rol nuevo.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Nombre del rol" />
            <x-input type="text" class="w-full" wire:model="name" />
            @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            {{-- Hay que arreglar que cuando se crean muchos permisos, no se ven en la pantalla, se corta. --}}
            <x-label value="Permisos" />
            <div class="flex">
                @foreach ($permisos as $permiso)
                <x-label value="{{$permiso->name}}" class="ml-2 mr-1" />
                <input wire:model="permiso_seleccionados.{{$permiso->name}}" value="{{ $permiso->name }}" type="checkbox" name="permiso_seleccionados" id="permiso_seleccionados">
                @endforeach
            </div>
            @error('permiso_seleccionados') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openCreate', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="save" wire:loading.attr="disabled" wire:target="save" class="disabled:opacity-25 ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300">
            Crear
        </button>

        <span wire:loading wire:target="save">
            <p>Cargando...</p>
        </span>
    </x-slot>

</x-dialog-modal>
