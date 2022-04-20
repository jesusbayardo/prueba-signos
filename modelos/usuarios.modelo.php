<?php

require_once "inyeccion.php";

class ModeloUsuarios
{
    //mostrar usuario
    //mostrar usuario
    //mostrar usuario

    static public function MdlMostrarUsuario($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("select *from $tabla where $item=:$item");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt - null;
    }



    //registro de ADMINISTRADOR
    //registro de ADMINISTRADOR
    //registro de ADMINISTRADOR


    static public function mdlIngresarUsuario($tabla, $datos)
    {


        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil,estado) VALUES (:nombre, :usuario, :password, :perfil,:estado)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;

    }



    //INGRESOEMPLEADOS
    //INGRESOEMPLEADOS
    static public function mdlIngresarEmpleado($tabla, $datos)
    {


        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil,estado,id_bodega) VALUES (:nombre, :usuario, :password, :perfil,:estado,:id_bodega)");
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }


    static public function MdlMostrarUsuarios($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select *from $tabla ");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt - null;
    }


    static public function MdlMostrarUsuariosActivos($tabla)
    {
        $stmt = Conexion::conectar()->prepare("select *from $tabla where estado=1");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt - null;
    }


    
	static public function mdlEditarUsuario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil WHERE usuario = :usuario");
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);	
		$stmt -> bindParam(":usuario", $datos["usuarios"], PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;

    }
    




    static public function mdlEditarEmpleado($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil,id_bodega=:id_bodega WHERE usuario = :usuario");
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuarios"], PDO::PARAM_STR);
        $stmt -> bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_STR);
        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
        $stmt = null;
    }
//ACTUALIZAR ESTADO USUARIO


static public function mdlActualizarEstado($tabla,$item1,$valor1,$item2,$valor2){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  $item1 = :$item1 WHERE $item2 = :$item2");
    $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
   

    if($stmt -> execute()){
        return "ok";
    }else{
        return "error";	
    }

    $stmt -> close();
    $stmt = null;

}







static public function mdlEditarPerfil($tabla, $datos){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, email = :email WHERE id = :id");
    $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
    $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
    if($stmt -> execute()){
        return "ok";
    }else{
        return "error";	
    }

    $stmt -> close();
    $stmt = null;
}



}
