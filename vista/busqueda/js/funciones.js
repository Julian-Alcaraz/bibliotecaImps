function abrirModalAutor(idAutor){
    console.log(idAutor); 
    arregloAutores.forEach(element => {
        if(element.idAutor==idAutor){
            // console.log(element);
            var contenidoModal = document.getElementById('contenidoModalAutor');
            contenidoModal.innerHTML = '';
            contenidoModal.innerHTML += '<h3>Datos del Autor</h3><div>' +
            '<p> Id: ' + element.idAutor +
            '<p> Nombre: ' +  element.nombreAutor+
            '<p> Apellido: ' + element.apellidoAutor +
            '<p> Nacionalidad: ' + element.lugarNacimiento + ' ' +
            '<p> Fecha Nacimiento: ' + element.fechaNacimiento  + '</div> </p> ';
        }
    });    
    $("#modalAutor").modal("show");
}
function abrirModalEditorial(idEditorial){
    console.log(idEditorial); 
    arregloEditoriales.forEach(element => {
        if(element.idEditorial==idEditorial){
            // console.log(element);
            var contenidoModalE = document.getElementById('contenidoModalEditorial');
            contenidoModalE.innerHTML = '';
            contenidoModalE.innerHTML += '<h3>Datos de la Editorial</h3><div>' +
            '<p> Id: ' + element.idEditorial +
            '<p> Nombre: ' +  element.nombreEditorial+'</div></p> ';
        }
    });    
    $("#modalEditorial").modal("show");
}
function submitForm(selectedValue) {
    // Aquí puedes realizar acciones con el valor seleccionado
    console.log('Valor seleccionado:', selectedValue);

    // Por ejemplo, podrías enviar el formulario
    document.getElementById('cambiarLista').submit();
}