<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


class AjaxUsuarios
{
    //editar usuario


    public $idUsuario;
    public function ajaxEditarUsuario()
    {

        $item = "id";
        $valor = $this->idUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);
    }

    //activar usuario

    public $activarId;
    public $activarUsuario;
    public function activarEstadoUsuario()
    {
        $item1 = "estado";
        $valor1 = $this->activarUsuario;
        $tabla = "usuarios";
        $item2 = "id";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarEstado($tabla, $item1, $valor1, $item2, $valor2);
        echo $respuesta;
    }

    //validar Usuario

    public $validarUsuario;
    public function validarUsuario(){


        $item = "usuario";
        $valor = $this->validarUsuario;
        $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);

    }



}


//editar usuario
if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}


//activar usuario
if (isset($_POST["activarId"])) {
    $activar = new AjaxUsuarios();
    $activar->activarId = $_POST["activarId"];
    $activar->activarUsuario = $_POST["activarUsuario"];
    $activar->activarEstadoUsuario();
}

//validar usuario
if (isset($_POST["validarUsuario"])) {
    $validarUser = new AjaxUsuarios();
    $validarUser->validarUsuario = $_POST["validarUsuario"];
  
    $validarUser->validarUsuario();
}

