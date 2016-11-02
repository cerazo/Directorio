

$(function () {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
});

var UtilToastMessage = function () {
    var msgDefault = "Por favor, comunicar al Administrador del Sistema!",

        errorGeneral = function(msg) {
            if (msg === "") {
                msg = msgDefault ;
            }
            toastr.options = {
                "positionClass": "toast-top-full-width",
                "fadeOut": 3000
            } ;
            toastr.error(msg,"Error.") ;
        },

        infoGeneral = function(msg) {
            if (msg === "") {
                msg = msgDefault ;
            }
            toastr.info(msg,"Info.") ;
        },

        successGeneral = function(msg) {
            if (msg === "") {
                msg = msgDefault ;
            }
            toastr.success(msg,"Ok.") ;
        },

        warningGeneral = function(msg) {
            if (msg === "") {
                msg = msgDefault ;
            }
            toastr.options = {
                "positionClass": "toast-top-center"
            }

            toastr.warning(msg,"Advertencia") ;
        },

        errorLogin = function (msg) {
            if (msg === null) {
                msg = msgDefault;
            }
            toastr.options = {
                    "positionClass": "toast-top-center"
            }
            toastr.error(msg,"Error.") ;
        };

    return {
        errorGeneral: errorGeneral,
        infoGeneral: infoGeneral,
        successGeneral: successGeneral,
        warningGeneral: warningGeneral,
        errorLogin: errorLogin
    };
}();