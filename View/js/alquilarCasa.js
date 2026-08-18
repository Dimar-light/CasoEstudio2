$(function () {

    function ActualizarPrecio() {

        const opcionSeleccionada = $("#idCasa option:selected");
        const precio = opcionSeleccionada.data("precio");

        if (precio === undefined || precio === "") {
            $("#precioCasa").val("");
            return;
        }

        const precioFormateado = new Intl.NumberFormat("es-CR", {
            style: "currency",
            currency: "CRC"
        }).format(precio);

        $("#precioCasa").val(precioFormateado);
    }

    $("#idCasa").on("change", function () {
        ActualizarPrecio();
    });

    ActualizarPrecio();

    $("#formAlquilarCasa").validate({

        rules: {

            idCasa: {
                required: true
            },

            usuarioAlquiler: {
                required: true,
                maxlength: 30
            }

        },

        messages: {

            idCasa: {
                required: "Campo obligatorio."
            },

            usuarioAlquiler: {
                required: "Campo obligatorio.",
                maxlength: "No puede superar los 30 caracteres."
            }

        },

        errorElement: "div",

        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".mb-3").append(error);
        },

        highlight: function (element) {
            $(element)
                .addClass("is-invalid")
                .removeClass("is-valid");
        },

        unhighlight: function (element) {
            $(element)
                .addClass("is-valid")
                .removeClass("is-invalid");
        }

    });

});