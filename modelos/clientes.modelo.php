<?php

require_once "inyeccion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cedula, nombres, fecha_nacimiemto, edad, 	temperatura,precion_arterial,pulso,frecuencia_respiratoria,saturacion,peso,talla,imc	)
		 VALUES (:cedula, :nombres, :fecha_nacimiemto, :edad, 	:temperatura,:precion_arterial,:pulso,:frecuencia_respiratoria,:saturacion,:peso,:talla,:imc	)");

		$stmt->bindParam(":cedula", $datos["cedula"], PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiemto", $datos["fecha_nacimiemto"], PDO::PARAM_STR);
		$stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":temperatura", $datos["temperatura"], PDO::PARAM_STR);
		$stmt->bindParam(":precion_arterial", $datos["precion_arterial"], PDO::PARAM_STR);

		$stmt->bindParam(":pulso", $datos["pulso"], PDO::PARAM_STR);
		$stmt->bindParam(":frecuencia_respiratoria", $datos["frecuencia_respiratoria"], PDO::PARAM_STR);
		$stmt->bindParam(":saturacion", $datos["saturacion"], PDO::PARAM_STR);
		$stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
		$stmt->bindParam(":talla", $datos["talla"], PDO::PARAM_STR);
		$stmt->bindParam(":imc", $datos["imc"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		

		$stmt -> close();

		$stmt = null;

	}






/*=============================================
	MOSTRAR CLIENTES ACTIVOS
	=============================================*/

	static public function mdlMostrarClientesActivos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and estado=1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where  estado=1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion,id_usuario=:id_usuario WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}





//ACTUALIZAR ESTADO CLIENTES


static public function mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2)
{
	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  $item1 = :$item1 WHERE $item2 = :$item2");
	$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
	$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);
	if ($stmt->execute()) {
		return "ok";
	} else {
		return "error";
	}

	$stmt->close();
	$stmt = null;
}
}