<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["cedula"])){

			if(
				preg_match('/^[0-9]+$/', $_POST["cedula"])&&
				preg_match('/^[A-Za-záéíóúAÉÍÓÚ ]+$/', $_POST["nombres"])&&
				preg_match('/^[0-9.]+$/', $_POST["peso"])&&
				preg_match('/^[0-9.]+$/', $_POST["temperatura"])&&
				preg_match('/^[0-9]+$/', $_POST["pulso"])&&
				preg_match('/^[0-9]+$/', $_POST["frecuencia_respiratoria"])&&
				preg_match('/^[0-9]+$/', $_POST["saturacion"])&&
				preg_match('/^[0-9.]+$/', $_POST["talla"])
			   ){

			   	$tabla = "pasciente";




				   
				   
			   	$datos = array(
					   		   "cedula"=>($_POST["cedula"]),
					           "nombres"=>strtoupper($_POST["nombres"]),
					           "fecha_nacimiemto"=>$_POST["fecha_nacimiemto"],
					           "edad"=>$_POST["edad"],
					           "temperatura"=>$_POST["temperatura"],
							   "precion_arterial"=>($_POST["precion_arterial"]),
							   "pulso"=>($_POST["pulso"]),
							   "frecuencia_respiratoria"=>($_POST["frecuencia_respiratoria"]),
							   "saturacion"=>($_POST["saturacion"]),
							   "peso"=>($_POST["peso"]),
							   "talla"=>($_POST["talla"]),
							   "imc"=>($_POST["imc"]),
				   );
							
				   



			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				  
			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Datos Guardados",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Ingrese datos correctamente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })

			  	</script>';



			}

		}

	}



	








	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarDatos(){

		$tabla = "pasciente";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla);

		return $respuesta;

	}


	
	

	


}

