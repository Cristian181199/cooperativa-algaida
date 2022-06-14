<x-action-section>
    <x-slot name="title">
        {{ __('Borrar cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Elimina tu cuenta de forma permanente.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes
            eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}
        </div>

        <div class="mt-5">
            <x-button variant="danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Borrar cuenta') }}
            </x-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Borrar cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Está seguro de que desea eliminar su cuenta? Una vez que se elimine su cuenta, todos sus recursos
                y los datos serán eliminados permanentemente. Por favor ingrese su contraseña para confirmar que desea
                eliminar permanentemente su cuenta.') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="block w-3/4 mt-1" placeholder="{{ __('Contraseña') }}"
                        x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-button variant="info" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-button>

                <x-button variant="danger" class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Borrar cuenta') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
