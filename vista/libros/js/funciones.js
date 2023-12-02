//cargar Libro
$(document).ready(function() {
    // reglas personalizadas
    $.validator.addMethod("soloLetras", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/i.test(value);
    }, "Solo se permiten letras en este campo");
    // valido formulario
    $("#cargarLibroForm").validate({
        // Seteo las reglas para cada campo
        rules: {
            nombreL: {
                required: true,
                soloLetras: true,
            },
            cantP: {
                required: true,
                min:1,
            },
            idioma: {
                required: true,
                soloLetras: true, 
            },
            anio: {
                required: true,
                maxlength: 4,
                min:1,
            },
        },
        // seteo los mensajes para cada campo
        messages: {
            nombreL: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            cantP: {
                required: "Este campo es requerido",
                min: "El minimo de paginas es 1",
            },
            idioma: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            anio: {
                required: "Este campo es requerido",
                maxlength: "Maximo 4 digitos ",
                min: "El minimo es 1",

            },
        },
        // defino como seran los mensajes de error
        errorElement: "div", 
        errorClass: "text-danger", 
        errorPlacement: function(error, element) 
        {   
            error.insertAfter(element);   
        },   
        // cuando es valido y le da a submit ejecuta ajax
        submitHandler: function(form){
            var nombre = $("#nombreL").val();
            var cantP = $("#cantP").val();
            var idioma = $("#idioma").val();
            var anio = $("#anio").val();
            var idAutor = $("#idAutor").val();
            var idEditorial = $("#idEditorial").val();
            var libroDeshabilitado = null;
            var accion = $("#accion").val();
            $.ajax({
                type: "POST",
                url: "./accion/cargarLibro.php", 
                data: { 
                    accion:accion,
                    idLibro: null,
                    nombreLibro: nombre,
                    cantidadPag : cantP,
                    idioma : idioma,
                    anioPublicacion : anio,
                    idAutor : idAutor,
                    idEditorial : idEditorial,
                    libroDeshabilitado : libroDeshabilitado,
                },
                success: function(response){
                    accionSuccess();
                },
                error: function(error) {
                    accionFailure()
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        }
    });
});

// cargar Autor
$(document).ready(function() {
    // valido formulario
    $.validator.addMethod("soloLetras", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/i.test(value);
    }, "Solo se permiten letras en este campo");
    $("#cargarAutorForm").validate({
        // Seteo las reglas para cada campo
        rules: {
            nombreA: {
                required: true,
                soloLetras: true,
            },
            apellidoA: {
                required: true,
                soloLetras: true,
            },
            nacionalidad: {
                required: true,
                soloLetras: true,
            },
            fecha: {
                required: true,
            },
            
        },
        // seteo los mensajes para cada campo
        messages: {
            nombreA: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            apellidoA: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            nacionalidad: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            fecha: {
                required: "Este campo es requerido",
            },
        },
        // defino como seran los mensajes de error
        errorElement: "div", 
        errorClass: "text-danger", 
        errorPlacement: function(error, element) 
        {   
            error.insertAfter(element);   
        },   
        // cuando es valido y le da a submit ejecuta ajax
        submitHandler: function(form){
            var nombre = $("#nombreA").val();
            var apellido = $("#apellidoA").val();
            var nacionalidad = $("#nacionalidad").val();
            var fecha = $("#fecha").val();
            var accion = $("#accion").val();
            $.ajax({
                type: "POST",
                url: "./accion/cargarAutor.php", 
                data: { 
                    accion: accion,
                    idAutor: null,
                    nombreAutor: nombre,
                    apellidoAutor : apellido,
                    lugarNacimiento : nacionalidad,
                    fechaNacimiento : fecha,
                    autorDeshabilitado: null,
                },
                success: function(response){
                    accionSuccess();
                },
                error: function(error) {
                    accionFailure()
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        }
    });
});

// Cargar Editorial
$(document).ready(function() {
    // valido formulario
    $.validator.addMethod("soloLetras", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/i.test(value);
    }, "Solo se permiten letras en este campo");
    $("#cargarEditorialForm").validate({
        // seteo las reglas de cada campo
        rules: {
            nombreE: {
                required: true,
                soloLetras: true,
            },
        },
        // defino los mensajes de error
        messages: {
            nombreE: {
                required: "Este campo es requerido",
                soloLetas: "Solo se permiten letras en este campo",
            },
        },
        // defino como seran los errores
        errorElement: "div", 
        errorClass: "text-danger", 
        errorPlacement: function(error, element) 
        {   
            error.insertAfter(element);   
        },   
        // cuando es valido y le da a submit ejecuta ajax
        submitHandler: function(form){
            var nombre = $("#nombreE").val();
            var accion =$("#accion").val();
            $.ajax({
                type: "POST",
                url: "./accion/cargarEditorial.php", 
                data: { 
                    accion: accion,
                    idEditorial: null,
                    nombreEditorial: nombre,
                    editorialDeshabilitado : null,
                },
                success: function(response){
                    accionSuccess();
                },
                error: function(error) {
                    accionFailure()
                    console.error("Error en la solicitud AJAX:", error);
                }
            });
        }
    });
}); 

// mensaje de error y succcess
function accionSuccess() {
    Swal.fire({
        icon: 'success',
        title: 'La accion se realizo correctamente!',
        showConfirmButton: false,
        timer: 3000
    })
    setTimeout(function(){
        location.reload();
    },3500);
}

function accionFailure() {
    Swal.fire({
        icon: 'error',
        title: 'No se ha realizado la accion!',
        showConfirmButton: false,
        timer: 3000
    })
    setTimeout(function(){
        location.reload();
    },3000);
}
