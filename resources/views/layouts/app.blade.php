<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'K UI') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Styles -->
    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
</head>

<body class="font-sans antialiased">

    <div x-data="mainState" :class="{ dark: isDarkMode }" @resize.window="handleWindowResize" x-cloak>
        <x-banner />

        <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200">
            <!-- Sidebar -->
            <x-sidebar.sidebar />

            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen" :class="{
                    'lg:ml-64': isSidebarOpen,
                    'md:ml-16': !isSidebarOpen
                }" style="transition-property: margin; transition-duration: 150ms;">

                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header>
                        <div class="p-4 sm:p-6">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 px-4 sm:px-6">
                    {{ $slot }}
                </main>

                <!-- Page Footer -->
                <x-footer />
            </div>
        </div>
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
        Livewire.on('error', function(message1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message1,
                })
        });
        Livewire.on('RoleSave', function(){
            Swal.fire(
                'Rol creado!',
                'Has creado el rol exitosamente!',
                'success'
            )
        });
        Livewire.on('rolUpdate', function(){
            Swal.fire(
                'Rol actualizado!',
                'Has actualizado el rol exitosamente!',
                'success'
            )
        });
        Livewire.on('PermisoSave', function(){
            Swal.fire(
                'Permiso creado!',
                'Has creado el permiso exitosamente!',
                'success'
            )
        });
        Livewire.on('permisoUpdate', function(){
            Swal.fire(
                'Permiso actualizado!',
                'Has actualizado el permiso exitosamente!',
                'success'
            )
        });
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
        ] );
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
                    Livewire.emitTo('roles-crud', 'delete', rol);
                    Swal.fire(
                    'Eliminado!',
                    'El rol ha sido eliminado.',
                    'success'
                    )
                }
                })
        ] );
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
                    Livewire.emitTo('permisos-crud', 'delete', permiso);
                    Swal.fire(
                    'Eliminado!',
                    'El permiso ha sido eliminado.',
                    'success'
                    )
                }
                })
        ] );
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
        ] );
        Livewire.on('deleteProducto', producto => [
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
                    Livewire.emitTo('productos', 'delete', producto);
                    Swal.fire(
                    'Eliminado!',
                    'El producto ha sido eliminado.',
                    'success'
                    )
                }
                })
        ] );
    </script>
</body>

</html>
