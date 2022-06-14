<x-dialog-modal wire:model="openShow">

    <x-slot name="title">
        <h1 class="text-2xl">Datos de la factura:</h1>
    </x-slot>

    <x-slot name="content">

        <div class="bg-white dark:bg-dark-eval-1 rounded-md max-w-4xl mx-auto p-4 space-y-4 shadow-lg">
        <h3 class=" mb-2 pt-3 font-semibold">Usuario al que va dirigida: <span class="font-thin">{{ $factura->user->name }}</span></p>
        <h3 class="border-t mb-2 pt-3 font-semibold">Codigo: <span class="font-thin">{{ $factura->codigo }}</span></p>
        <h3 class="border-t mb-2 pt-3 font-semibold">Suministros:
            <span class="font-thin">
                @foreach ($factura->suministros as $suministro)
                    {{ $suministro->denominacion }}
                @endforeach
            </span></p>
        <h3 class="border-t mb-2 pt-3 font-semibold">Precio total: <span class="font-thin">{{ $factura->suministros->sum('precio') }} €</span></p>
    </div>

    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openShow', false)" class="p-2 pl-5 pr-5 bg-red-500 hover:bg-red-400 text-white rounded-full text-lg  focus:border-4 ring-red-500">
            Volver
        </button>
    </x-slot>

</x-dialog-modal>
