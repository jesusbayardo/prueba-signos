












$('.tablahistoria').DataTable({

  "ajax": "ajax/clientes.ajax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }

  }

});





$("#fecha_nacimiemto").change(function () {
  console.log("entro edad ")
  var fecha = $(this).val();
 
  var hoy = new Date();
  var cumpleanos = new Date(fecha);
  var edad = hoy.getFullYear() - cumpleanos.getFullYear();
  var m = hoy.getMonth() - cumpleanos.getMonth();

  if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
      edad--;
  }
             
  
               $("#edad").val(edad);
          
})






// CALCULAR IMC

$("#peso").change(function () {
 
  var peso = $(this).val();
 
 var talla = $("#talla").val();
  

  var altura=talla/100;
  var imc=(peso/(altura*altura));
  
  let  formateo=imc.toFixed(3);
    console.log(formateo)
    
                 $("#imc").val(formateo);
})



$("#talla").change(function () {
 
  var talla = $(this).val();
 
 var peso = $("#peso").val();
 

      var altura=talla/100;
      var imc=(peso/(altura*altura));

let  formateo=imc.toFixed(3);
  console.log(formateo)
  
               $("#imc").val(formateo);
          
})



function valideKeyForemat(evt){
    




  var code = (evt.which) ? evt.which : evt.keyCode;
  
  if(code==8) { // backspace.
    return true;
  } else if(code>=47 && code<=57) { 
    var presion=$("#presion").val();
 console.log(presion.length)
if(presion.length==3){
  $("#presion").val(presion+"/")

}
    
    // is a number.
    return true;
  } else{ // other keys.
    return false;
  }

 
}
