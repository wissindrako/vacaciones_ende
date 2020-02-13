$(document).ready(function () {
    // $("#tabla-data").on('submit', '.form-eliminar', function (event) {
    //     event.preventDefault();
    //     const form = $(this);
    //     swal({
    //         title: '¿ Está seguro que desea eliminar el registro ?',
    //         text: "Esta acción no se puede deshacer!",
    //         icon: 'warning',
    //         buttons: {
    //             cancel: "Cancelar",
    //             confirm: "Aceptar"
    //         },
    //     }).then((value) => {
    //         if (value) {
    //             ajaxRequest(form.serialize(), form.attr('action'), 'eliminarLibro', form);
    //         }
    //     });
    // });

    $('#btn-imprimir').on('click', function (event) {
        var ficha=document.getElementById('areaImprimir');
        var ventimp=window.open(' ','popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
    });

    $('.ver-vacaciones').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        const data = {
            _token: $('input[name=_token]').val()
        }
        ajaxRequest(data, url, 'verVacaciones');
    });

    function ajaxRequest(data, url, funcion, form = false) {
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (respuesta) {
                if (funcion == 'eliminarLibro') {
                    if (respuesta.mensaje == "ok") {
                        form.parents('tr').remove();
                        Sistema.notificaciones('El registro fue eliminado correctamente', 'Sistema', 'success');
                    } else {
                        Sistema.notificaciones('El registro no pudo ser eliminado, hay recursos usandolo', 'Sistema', 'error');
                    }
                } else if (funcion == 'verVacaciones') {
                    $('#modal-ver-vacaciones .modal-body').html(respuesta)
                    $('#modal-ver-vacaciones').modal('show');
                }
            },
            error: function () {

            }
        });
    }
});