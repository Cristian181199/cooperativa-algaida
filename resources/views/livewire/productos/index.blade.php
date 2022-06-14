<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de productos
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <button wire:click="$set('openCreate', true)" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full disabled:opacity-25">
                Crear nuevo producto
            </button>
        </div>

        @if ($openShow)
            @include('livewire.prodcutos.show')
        @endif

        @if ($openCreate)
            @include('livewire.productos.create')
        @endif

        @if ($openEdit)
            @include('livewire.productos.edit')
        @endif

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Denominacion
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Clase
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Imagen
                                </th>
                                <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($productos as $producto)
                                <tr>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $producto->denominacion }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $producto->clase }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <img class="w-10 h-10 rounded-full"
                                                src="{{ Storage::disk('s3')->url($producto->imagen)}}"
                                                alt="{{ $producto->denominacion }}" />

                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                        <a wire:click="show({{$producto}})" class="cursor-pointer mb-2 mr-2 inline-flex bg-blue-500 hover:bg-blue-700 text-white rounded-full h-6 px-3 justify-center items-center">Ver</a>
                                        <a wire:click="edit({{$producto}})" class="cursor-pointer mb-2 mr-2 inline-flex bg-indigo-500 hover:bg-indigo-700 text-white rounded-full h-6 px-3 justify-center items-center">Editar</a>
                                        <a wire:click="$emit('deleteProducto', {{$producto}})" class="cursor-pointer mb-2 mr-2 inline-flex bg-red-500 hover:bg-red-700 text-white rounded-full h-6 px-3 justify-center items-center">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
