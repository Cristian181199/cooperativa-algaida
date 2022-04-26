<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de permisos
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <button wire:click="$set('openCreate', true)"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full disabled:opacity-25">
                Crear nuevo permiso
            </button>
        </div>
        @if ($openCreate)
        @include('livewire.permisos.create')
        @endif

        @if ($openEdit)
        @include('livewire.permisos.edit')
        @endif

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                                <tr>
                                    <th scope="col" width="50"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($permisos as $permiso)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $permiso->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $permiso->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex">
                                            <a wire:click="edit({{$permiso}})"
                                                class="cursor-pointer mb-2 mr-2 inline-flex bg-indigo-500 hover:bg-indigo-700 text-white rounded-full h-6 px-3 justify-center items-center">Editar</a>
                                            <a wire:click="$emit('deletePermiso', {{$permiso}})"
                                                class="cursor-pointer mb-2 mr-2 inline-flex bg-red-500 hover:bg-red-700 text-white rounded-full h-6 px-3 justify-center items-center">Eliminar</a>
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
