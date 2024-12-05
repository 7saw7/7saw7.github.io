$(document).ready(function() {
    $('#submitSolicitud').click(function() {
        var cantidad = $('input[name="cantidad"]').val();
        var lista = $('input[name="lista"]').val().split(',');

        $.post('RegistrarSolicitudPedidoController.php', {
            buttonSubPrivilegio: 'Registrar Solicitud Producto',
            cantidad: cantidad,
            lista: lista
        }, function(response) {
            console.log('Respuesta del servidor:', response);
            // Actualizar la tabla en formRegistrarVentas con los nuevos datos
            $('#solicitudesTabla').load('formRegistrarVentas.php #solicitudesTabla > *', function() {
                console.log('Tabla actualizada');
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
        });
    });
});

