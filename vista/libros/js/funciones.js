//cargar Libro
$(document).ready(function() {
    // valido formulario
    $.validator.addMethod("soloLetras", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\sáéíóúÁÉÍÓÚñÑüÜ]+$/i.test(value);
    }, "Solo se permiten letras en este campo");
    $("#cargarLibroForm").validate({
        rules: {
            nombreL: {
                required: true,
                soloLetras: true,
            },
            cantP: {
                required: true,
            },
            idioma: {
                required: true,
                soloLetras: true,
            },
            anio: {
                required: true,
            },
            
        },
        messages: {
            nombreL: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            cantP: {
                required: "Este campo es requerido",
            },
            idioma: {
                required: "Este campo es requerido",
                soloLetras: "Solo se permiten letras en este campo",
            },
            anio: {
                required: "Este campo es requerido",
            },
        },
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
            
            console.log(nombre,cantP,idioma,anio);
            console.log(idAutor);
            console.log(idEditorial);
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
            var fechaAux = new Date(fecha);

            // Obtener los componentes de la fecha y hora
            var year = fechaAux.getFullYear();
            var month = (fechaAux.getMonth() + 1).toString().padStart(2, '0'); // Los meses comienzan desde 0, por eso sumamos 1
            var day = fechaAux.getDate().toString().padStart(2, '0');
            var fechaSql = `${year}-${month}-${day}`;

            console.log(fechaSql);
            console.log(nombre);
            console.log(apellido);
            console.log(nacionalidad);
            console.log(fecha);
            console.log(accion);
            $.ajax({
                type: "POST",
                url: "./accion/cargarAutor.php", 
                data: { 
                    accion: accion,
                    idAutor: null,
                    nombreAutor: nombre,
                    apellidoAutor : apellido,
                    lugarNacimiento : nacionalidad,
                    fechaNacimiento : fechaSql,
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
    $("#cargarLibroForm").validate({
        rules: {
            nombreL: {
                required: true,
                soloLetras: true,
            },
            cantP: {
                required: true,
            },
            idioma: {
                required: true,
            },
            anio: {
                required: true,
            },
            
        },
        messages: {
            nombreL: {
                required: "Este campo es requerido",
                soloLetas: "Solo se permiten letras en este campo",
            },
            cantP: {
                required: "Este campo es requerido",
            },
            idioma: {
                required: "Este campo es requerido",
            },
            anio: {
                required: "Este campo es requerido",
            },
        },
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
            var accion = 'nuevo'
            
            console.log(nombre,cantP,idioma,anio);
            console.log(idAutor);
            console.log(idEditorial);
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