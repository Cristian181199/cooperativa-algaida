<x-dialog-modal wire:model="openCreate">

    <x-slot name="title">
        Crear usuario nuevo.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Nombre del usuario" />
            <x-input type="text" class="w-full" wire:model="name" />
            @error('name') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Email del usuario" />
            <x-input type="text" class="w-full" wire:model="email" />
            @error('email') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Contrasenya del usuario" />
            <x-input type="password" class="w-full" name="password" wire:model="password" />
            @error('password') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Repite la contrasenya del usuario" />
            <x-input type="password" class="w-full" name="password_confirmation" wire:model="password_confirmation" />
            @error('password_confirmation') <span class="text-red-500 error">{{ $message }}</span> @enderror
        </div>

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
        <button wire:click="$set('openCreate', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="save" wire:target="save" wire:loading.attr="disabled" class="ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300 disabled:opacity-25">
            Crear
        </button>

        <span wire:loading wire:target="save">
            Cargando...
        </span>
    </x-slot>

</x-dialog-modal>
