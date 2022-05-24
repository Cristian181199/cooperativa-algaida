# Cooperativa Algaida

El proyecto consiste en una aplicación web, mediante la cual sé podrá gestionar una cooperativa agroalimentaria.


## Funcionalidad principal de la aplicación

La principal funcionalidad de la aplicación es la gestión de una cooperativa agroalimentaria.

Por una parte los socios de la cooperativa podrán consultar:

- Los precios de las subastas.

- Facturas de suministros.

- Albaranes de subasta.

- Facturas por pago.

- Calendario de pago.

- Albaranes pendientes de facturar.

- Comunicados.

Opcionalmente podrán registrar su/s parcela/s.

Por otra parte, los administradores podrán gestionar todo lo que tenga que ver con la gestión de socios, subastas, parcelas, albaranes, comunicados, facturas y calendario de pagos.

## Objetivos generales

### Objetivo principal

- Que los usuarios socios puedan consultar de manera fácil y directa su actividad en la cooperativa y que los usuarios administradores puedan gestionar todo lo relacionado con la cooperativa.

#### Objetivos de los socios

- Consultar el precio de las subastas, albaranes de las subastas, comunicados, el calendario de pagos, facturas por pago y las facturas por suministro.

- Gestionar sus parcelas.

- Generar PDF's de facturas y albaranes.

#### Objetivos de los administradores

- Gestión de socios.

- Gestión de subastas.

- Gestión del calendario de pago.

- Gestión de parcelas.

- Gestión de albaranes.

- Gestión de comunicados.

- Gestión de facturas.

### Casos de uso

- Invitado: "ver el index".

- Socio: "iniciar sesion", "cerrar sesion", "añadir una parcela", "eliminar una parcela", "modificar una parcela", "modificar la información de su perfil", "consultar el precio de las subastas", "consultar las facturas", "consultar los albaranes de subasta". "consultar sus parcelas", "ver las comunicaciones", "ver la gráfica de ganacias por mes".

- Administrador: "iniciar sesión", "cerrar sesión", "modificar su perfil", "CRUD de socios", "CRUD de parcelas", "CRUD de facturas", "CRUD de subastas", "CRUD de albaranes", "CRUD de comunicaciones", "añadir días de pago", "eliminar días de pago".

# Elemento de innovación

Esta aplicación hará uso de 2 APIS de Google, AWS S3 y laravel livewire:

- API de Google Maps para que el socio pueda registrar la ubicación de su/s parcela/s.

- API de Google calendar para que el socio pueda ver la fecha de pago y no se olvide.

- Guardar imágenes / documentos en la nube de AWS S3.

- Se hace uso de laravel livewire para gestionar la asincronía de la aplicación y la parte de JS.
