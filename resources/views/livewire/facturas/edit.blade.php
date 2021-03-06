<x-dialog-modal wire:model="openEdit">

    <x-slot name="title">
        Editar factura.
    </x-slot>

    <x-slot name="content">

        <div class="mb-4">
            <x-label value="Codigo de la factura" />
            <x-input type="text" class="w-full" wire:model="factura.codigo" />
            @error('factura.codigo') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <x-label value="Usuario al que va la factura"/>
            <select wire:model="factura.user_id" name="usuario" id="usuario" class="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring
            focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1
            dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                <option disabled selected> Selecciona un usuario... </option>
                @foreach ($usuarios as $usuario)
                    <option value="{{$usuario->id}}"> {{ $usuario->name }} </option>
                @endforeach
            </select>
            @error('factura.user_id') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mt-4 overflow-auto border-gray-800 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
            <h3>Suministros</h3>
            @foreach ($suministros as $suministro)
            <div class="flex">
                <x-label value="{{$suministro->denominacion}}" class="ml-2 mr-1"/>
                <input wire:model="suministros_seleccionados.{{$suministro->denominacion}}" value="{{ $suministro->id }}" type="checkbox" name="suministros_seleccionados" id="suministros_seleccionados">
            </div>
            @endforeach
            @error('suministros_seleccionados') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>


    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('openEdit', false)" class="p-2 pl-5 pr-5 bg-gray-500 text-gray-100 rounded-full text-lg  focus:border-4 border-gray-300">
            Cancelar
        </button>

        <button wire:click="update" class="ml-4 p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-full focus:border-4 border-green-300">
            Editar
        </button>
    </x-slot>

</x-dialog-modal>
