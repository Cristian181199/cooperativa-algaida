<x-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        Editar usuario.
    </x-slot>

    <x-slot name="content" class="flex flex-col">

        <div class="mt-4">
            <x-label value="Nombre del usuario" />
            <x-input type="text" class="w-full" wire:model="user.name" />
        </div>
        @error('user.name') <span class="text-red-500 error">{{ $message }}</span> @enderror

        <div class="mt-4">
            <x-label value="Email del usuario" />
            <x-input type="text" class="w-full" wire:model="user.email" />
        </div>
        @error('user.email') <span class="text-red-500 error">{{ $message }}</span> @enderror

        <div class="mt-4">
            <x-label value="Contrasenya nueva" />
            <x-input type="password" class="w-full" wire:model="password" />
        </div>
        @error('password') <span class=" text-red-500 error">{{ $message }}</span> @enderror

        <div class="mt-4">
            <x-label value="Repite la contreasenya" />
            <x-input type="password" class="w-full" wire:model="password_confirmation" />
        </div>
        @error('password_confirmation') <span class="text-red-500 error">{{ $message }}</span> @enderror

        <div class="mt-4">
            <x-label value="Roles" />
            <div class="flex">
                @foreach ($roles as $rol)
                    <x-label value="{{$rol->name}}" class="ml-2 mr-1" />
                    <input wire:model="roles_seleccionados.{{$rol->name}}" value="{{ $rol->name }}" type="checkbox" name="roles_seleccionados" id="roles_seleccionados">
                @endforeach
            </div>
        </div>
        @error('roles_seleccionados') <span class="text-red-500 error">{{ $message }}</span> @enderror
    </x-slot>

    <x-slot name="footer">
        <button wire:click="cerrarModalEdit" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 text-lg rounded-full focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="update" wire:target="update" wire:loading.attr="disabled" class="ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300 disabled:opacity-25">
            Crear
        </button>

        <span wire:loading wire:target="update">
            Cargando...
        </span>
    </x-slot>

</x-dialog-modal>
