$(document).ready(function () {
    // Auto-hiding navbar
    $("#navbar-auto-hidden").autoHidingNavbar();

    // Mobile menu toggle
    $(".button-mobile-menu").click(function () {
        $("#mobile-menu-list").animate({ width: "toggle" }, 200);
    });

    // Tooltip initialization
    $(".all-elements-tooltip").tooltip("hide");

    // User configuration modal
    $(".userConBtn").on("click", function (e) {
        e.preventDefault();
        const code = $(this).data("code");
        if (!code) return;
        $.ajax({
            url: "./process/selectDataUser.php",
            type: "POST",
            data: { code },
            beforeSend: function () {
                $("#UserConData").html('<p class="text-center">Cargando...</p>');
            },
            success: function (data) {
                $("#UserConData").html(data);
                $("#ModalUpUser").modal({
                    show: true,
                    backdrop: "static",
                });
            },
            error: function () {
                $("#UserConData").html('<p class="text-danger">Error al cargar los datos del usuario.</p>');
            },
        });
    });

    // Logout confirmation
    $(".exit-system").on("click", function (e) {
        e.preventDefault();
        swal(
            {
                title: "¿Quieres salir del sistema?",
                text: "Estas seguro que quieres cerrar la sesión actual?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#16a085",
                confirmButtonText: "Sí, salir",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                animation: "slide",
            },
            function () {
                window.location = "process/logout.php";
            }
        );
    });

    // Form submission with Ajax
    $(".FormCatElec").submit(function (e) {
        e.preventDefault();

        const form = $(this);
        const formType = form.data("form");
        const formAction = form.attr("action");
        const method = form.attr("method") || "POST";
        const formData = window.FormData ? new FormData(form[0]) : form.serialize();

        const handleAjaxSuccess = function (data) {
            if (formType === "login") {
                $(".ResFormL").html(data);
            } else {
                swal({
                    title: "Operación exitosa",
                    text: "Se completó la operación solicitada.",
                    type: "success",
                    confirmButtonText: "Aceptar",
                });
                $(".ResbeforeSend").html(data);
            }
        };

        const handleAjaxError = function () {
            const errorMsg = "Ha ocurrido un error en el sistema. Inténtelo nuevamente.";
            if (formType === "login") {
                $(".ResFormL").html(errorMsg);
            } else {
                $(".ResbeforeSend").html(errorMsg);
            }
        };

        if (formType === "login") {
            // Login specific Ajax handling
            $(".ResFormL").html("Iniciando sesión...");
            $.ajax({
                type: method,
                url: formAction,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: handleAjaxSuccess,
                error: handleAjaxError,
            });
        } else {
            // General form submission with confirmation
            swal(
                {
                    title: "¿Estás seguro?",
                    text: "Quieres realizar la operación solicitada. Esta acción no se puede deshacer.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#16a085",
                    confirmButtonText: "Sí, realizar",
                    cancelButtonText: "No, cancelar",
                    closeOnConfirm: false,
                },
                function () {
                    $.ajax({
                        type: method,
                        url: formAction,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            $(".ResbeforeSend").html(
                                '<div class="content-send-form"><p class="text-center">Procesando...</p><div class="progress progress-striped active"><div class="progress-bar"></div></div></div>'
                            );
                        },
                        success: handleAjaxSuccess,
                        error: handleAjaxError,
                        xhr: function () {
                            const xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener(
                                "progress",
                                function (evt) {
                                    if (evt.lengthComputable) {
                                        const percentComplete = parseInt((evt.loaded / evt.total) * 100);
                                        $(".progress-bar").css("width", percentComplete + "%");
                                    }
                                },
                                false
                            );
                            return xhr;
                        },
                    });
                }
            );
        }
    });
});
