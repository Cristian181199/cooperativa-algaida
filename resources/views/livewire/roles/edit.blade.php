<x-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        Editar rol.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Nombre del rol" />
            <x-input type="text" class="w-full" wire:model="rol.name" />
            @error('rol.name') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4">
            <x-label value="Permisos" />
            <div class="flex">
                @foreach ($permisos as $permiso)
                    <x-label value="{{$permiso->name}}" class="ml-2 mr-1" />
                    <input wire:model="permiso_seleccionados.{{$permiso->name}}" value="{{ $permiso->name }}" type="checkbox" name="permiso_seleccionados" id="permiso_seleccionados">
                @endforeach
            </div>
        </div>
        @error('permiso_seleccionados') <span class="text-red-500 error">{{ $message }}</span> @enderror

    </x-slot>

    <x-slot name="footer">
        <button wire:click="cerrarModalEdit" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="update" wire:loading.attr="disabled" wire:target="update" class="disabled:opacity-25 ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300">
            Editar
        </button>

        <span wire:loading wire:target="update">
            <p>Cargando...</p>
        </span>
    </x-slot>

</x-dialog-modal>
