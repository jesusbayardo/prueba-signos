//EDITAR USUARIO
//EDITAR USUARIO
//EDITAR USUARIO
/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarUsuario", function () {
  

  var id = $(this).attr("idUsuario");

  var datos = new FormData();
  datos.append("idUsuario", id);

  $.ajax({

    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#editarNombre").val(respuesta["nombre"]);
      $("#editarUsuario").val(respuesta["usuario"]);
      $("#editarPerfil").html(respuesta["perfil"]);
      $("#editarPerfil").val(respuesta["perfil"]);
      $("#passwordActual").val(respuesta["password"]);
      $("#id_bodegaEditar").val(respuesta["id_bodega"]);
    }

  });

})


//acivar usuario


$(document).on("click", ".btnActivar", function(){

  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");
  

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);
  $.ajax({

    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    contentType: false,
    cache: false,
    processData: false,
    success: function (respuesta) {

      if (window.matchMedia("(max-width:767px)").matches) {
        swal({
          type: "success",
          title: "Actualización Correcta",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
          closenConfirm: false


        }).then((result) => {

          if (result.value) {
            window.location = "usuarios";
          }

        })



      }



    }
  });


  if (estadoUsuario == 0) {
    $(this).removeClass('btn-success')
    $(this).addClass('btn-danger')
    $(this).html("Desactivado")
    $(this).attr("estadoUsuario", 1)

  } else {
    $(this).removeClass('btn-danger')
    $(this).addClass('btn-success')
    $(this).html("Activado")
    $(this).attr("estadoUsuario", 0)

  }



})


//revisar usario repetido

$("#nuevoUsuario").change(function () {
  $(".alert").remove();

  var usuario = $(this).val();
  var datos = new FormData();
  datos.append("validarUsuario", usuario);
  $.ajax({

    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    contentType: false,
    cache: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      if (respuesta) {
      
        $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Usuario existente  </div>');
        $("#nuevoUsuario").val("");
      }

    }
  });





})