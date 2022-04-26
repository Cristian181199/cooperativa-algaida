<x-jet-dialog-modal wire:model="openShow">

    <x-slot name="title">
        <h1 class="text-2xl">Datos del usuario:</h1>
    </x-slot>

    <x-slot name="content">

        <div class="bg-white rounded-md max-w-4xl mx-auto p-4 space-y-4 shadow-lg">
        <h3 class=" mb-2 pt-3 font-semibold">Nombre: <span class="font-thin">{{ $user->name }}</span></p>
        <h3 class="border-t mb-2 pt-3 font-semibold">Email: <span class="font-thin">{{ $user->email }}</span></p>
        <h3 class="border-t mb-2 pt-3 font-semibold">Roles:
            <span class="font-thin">
                @foreach ($user->roles as $rol)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ $rol->name }}
                </span>
                @endforeach
            </span></p>
    </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openShow', false)" class="p-2 pl-5 pr-5 bg-red-500 hover:bg-red-400 text-white rounded-full text-lg  focus:border-4 ring-red-500">
            Volver
        </button>
    </x-slot>

</x-jet-dialog-modal>
