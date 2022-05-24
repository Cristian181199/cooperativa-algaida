<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        <script>
            Livewire.on('success', function(message1, message2){
                Swal.fire(
                    message1,
                    message2,
                    'success'
                )
            });
            // Hay que generalizar esto, no puede ser que cada vez que vaya a borrar tenga que
            // crear una nueva..
            Livewire.on('deletePermiso', permiso => [
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('permisos', 'delete', permiso);
                            Swal.fire(
                            'Eliminado!',
                            'El permiso ha sido eliminado.',
                            'success'
                            )
                        }
                    })
            ]);

            Livewire.on('deleteRol', rol => [
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('roles', 'delete', rol);
                            Swal.fire(
                            'Eliminado!',
                            'El rol ha sido eliminado.',
                            'success'
                            )
                        }
                    })
            ]);

            Livewire.on('deleteUser', user => [
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('usuarios', 'delete', user);
                            Swal.fire(
                            'Eliminado!',
                            'El usuario ha sido eliminado.',
                            'success'
                            )
                        }
                    })
            ]);

            Livewire.on('deleteSuministro', suministro => [
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('suministros', 'delete', suministro);

                        Swal.fire(
                        'Eliminado!',
                        'El suministro ha sido eliminado.',
                        'success'
                        )
                    }
                    })
            ]);

            Livewire.on('deleteFactura', factura => [
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "No podras revertir esta accion!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminalo!',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('facturas', 'delete', factura);

                        Swal.fire(
                        'Eliminado!',
                        'La factura ha sido eliminada.',
                        'success'
                        )
                    }
                    })
            ]);
        </script>
    </body>
</html>
