// funcion para abrir el modal autor
function abrirModalAutor(idAutor){
    // recorro el arreglo  de autores, que agregue a script con anterioridad
    arregloAutores.forEach(element => {
        // si el id del element(auto del array) es igual al id que recibo por parametro lo muestro
        if(element.idAutor==idAutor){
            // console.log(element);
            var contenidoModal = document.getElementById('contenidoModalAutor');
            contenidoModal.innerHTML = '';
            contenidoModal.innerHTML += '<h3>Datos del Autor</h3><table class="table table-bordered ">' +
            '<tr><td> Id:</td><td> ' + element.idAutor + '</td></tr>'+
            '<tr><td> Nombre: </td><td>' +  element.nombreAutor+ '</td></tr>'+
            '<tr><td> Apellido: </td><td>' + element.apellidoAutor + '</td></tr>'+
            '<tr><td> Nacionalidad: </td><td>' + element.lugarNacimiento + '</td></tr>'+
            '<tr><td> Fecha Nacimiento: </td><td>' + element.fechaNacimiento  + '</td></tr> </table> ';
        }
    });    
    // abro el modal
    $("#modalAutor").modal("show");
}
function abrirModalEditorial(idEditorial){
    // recorro el arreglo  de autores, que agregue a script con anterioridad
    arregloEditoriales.forEach(element => {
        // si el id del element(auto del array) es igual al id que recibo por parametro lo muestro
        if(element.idEditorial==idEditorial){
            var contenidoModalE = document.getElementById('contenidoModalEditorial');
            contenidoModalE.innerHTML = '';
            contenidoModalE.innerHTML += '<h3>Datos de la Editorial</h3><table class="table table-bordered ">' +
            '<tr><td> Id:</td><td>' + element.idEditorial + '</td></tr>'+
            '<tr><td> Nombre:</td> <td>' +  element.nombreEditorial+'</td></tr>'+
            '</table> ';
        }
    });    
    // abro el modal
    $("#modalEditorial").modal("show");
}
// permite enviar el dato del formulario buscar por editorial
function submitForm(selectedValue) {
    document.getElementById('cambiarLista').submit();
}
function eliminarLibro(idLibro){
    var accion ="borrarLogico";
    $.ajax({
        type: "POST",
        url: "./accion/administrarLibros.php", 
        data: { 
            accion: accion,
            idLibro: idLibro,
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
