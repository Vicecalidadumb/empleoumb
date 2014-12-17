$(document).ready(function() {

    $("#USUARIO_FECHADENACIMIENTO,.datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd",
        yearRange: '1930:2014'
    });

    $('#formal_insert').validate({
        rules: {
            UNIVERSIDAD: {
                required: true
            },
            TITULO: {
                required: true
            },
            FECHA_TERMINACION: {
                minlength: 10,
                required: true/*,
                date: true*/
            },
            FECHA_GRADO: {
                minlength: 10,
                required: true/*,
                date: true*/
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        }
    });

    $('#noformal_insert').validate({
        rules: {
            UNIVERSIDAD: {
                required: true
            },
            TITULO: {
                required: true
            },
            INTENSIDAD: {
                required: true,
                digits: true
            },
            FECHA_TERMINACION: {
                minlength: 10,
                required: true/*,
                date: true*/
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        }
    });

    $('#laboral_insert').validate({
        rules: {
            UNIVERSIDAD: {
                required: true
            },
            CARGO: {
                required: true
            },
            FECHA_INICIO: {
                minlength: 10,
                required: true/*,
                date: true*/
            },
            FECHA_FIN: {
                minlength: 10,
                required: true/*,
                date: true*/
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        }
    });

    $('#register_insert').validate({
        rules: {
            USUARIO_NUMERODOCUMENTO: {
                minlength: 2,
                required: true,
                digits: true
            },
            USUARIO_NOMBRES: {
                minlength: 2,
                required: true
            },
            USUARIO_APELLIDOS: {
                minlength: 2,
                required: true
            },
            USUARIO_FECHADENACIMIENTO: {
                minlength: 10,
                required: true/*,
                date: true*/
            },
            DEPARTAMENTO_NACIMIENTO: {
                required: true
            },
            USUARIO_LUGARDENACIMIENTO: {
                required: true
            },
            DEPARTAMENTO_RESIDENCIA: {
                required: true
            },
            USUARIO_LUGARDERESIDENCIA: {
                required: true
            },
            USUARIO_TELEFONOFIJO: {
                required: true
            },
            USUARIO_CORREO: {
                required: true,
                equalTo: "#USUARIO_CORREO_2",
                email: true
            },
            USUARIO_CORREO_2: {
                required: true,
                email: true
            },
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        }
    });

    $('.loading-example-btn-all').click(function() {
        var btn = $(this)
        btn.button('loading')
    });

    $('.loading-example-btn').click(function() {
        var btn = $(this)
        btn.button('loading')
        var form = $("#register_insert");
        if (form.valid() == false) {
            btn.button('reset')
        }
    });

    $('.loading-example-btn-2').click(function() {
        var btn = $(this)
        btn.button('loading')
        var form = $("#formal_insert");
        if (form.valid() == false) {
            btn.button('reset')
        }
    });

    $('.loading-example-btn-3').click(function() {
        var btn = $(this)
        btn.button('loading')
        var form = $("#noformal_insert");
        if (form.valid() == false) {
            btn.button('reset')
        }
    });

    $('.loading-example-btn-4').click(function() {
        var btn = $(this)
        btn.button('loading')
        var form = $("#laboral_insert");
        if (form.valid() == false) {
            btn.button('reset')
        }
    });


});
function get_mun(dep, span, select, index) {
    $.ajax({
        data: "dep=" + dep + "&select=" + select + "&index=" + index,
        type: "POST",
        dataType: "html",
        url: base_url_js + "registro/get_mun",
        success: function(data) {
            $("#" + span).html(data)
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("Error al Cargar los municipios, por favor seleccione nuevamente el departamento.")
        },
        async: true
    });
}