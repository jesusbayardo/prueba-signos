<?php
class ControladorUsuarios
{
    static public  function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {
            if (
                preg_match('/^[a-zA-Z1-9  ]+$/', $_POST["ingUsuario"])
                && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];
                $respuesta = ModeloUsuarios::MdlMostrarUsuario($tabla, $item, $valor);
                $encriptar =  crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

               
                if ($respuesta != null) {

                    if ($respuesta["estado"] == 1) {
                        if ($respuesta["password"] == $encriptar && $respuesta["usuario"] == $_POST["ingUsuario"]) {
                            $_SESSION["iniciarSesionFacturacion"] = "ok";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["usuario"] = $respuesta["usuario"];
                            

                           
                                echo '
                                    <script>
                                     window.location="clientes";
                                     </script>
                                     ';
                            
                        }else {
                            echo '<br>';
                            echo '<div class="alert alert-danger"> Error al ingresas, intentalo de nuevo  </div>';
                        }
                    } else {

                        echo '<br>';
                        echo '<div class="alert alert-danger"> Usuario inactivo  </div>';
                    }
                } else {
                    echo '<br>';
                    echo '<div class="alert alert-danger"> Error al ingresas, intentalo de nuevo  </div>';
                }
            }else {
                echo '<br>';
                echo '<div class="alert alert-danger"> Error al ingresas, intentalo de nuevo  </div>';
            }
        }
    }
    // crear usuario ADMINISTRADOR
    // crear usuario ADMINISTRADOR
    // crear usuario ADMINISTRADOR
    // crear usuario ADMINISTRADOR
    static public  function ctrCrearUsuario()
    {
        if (isset($_POST["nuevoUsuario"])) {
            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match(
                    '/^[a-zA-z0-9]+$/',
                    $_POST["nuevoUsuario"] &&
                        preg_match('/^[a-zA-z0-9]+$/', $_POST["nuevoPassword"])
                )
            ) {

                $tabla = "usuarios";
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "nombre" => strtoupper($_POST["nuevoNombre"]),
                    "password" =>  $encriptar,
                    "perfil" => $_POST["nuevoPerfil"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "estado" => 1

                );

                var_dump($datos);

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '
                    <script>
                    swal({
                            type:"success",
                            title:"Registro correcto",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="administrador";
                            }
    
                    })
                    
                    </script>
                    ';
                } else {

                    echo '
                    <script>
                    swal({
                            type:"error",
                            title:"Datos no insertados",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="administrador";
                            }
    
                    })
                    
                    </script>
                    ';
                }
            } else {

                echo '
                <script>
                swal({
                        type:"error",
                        title:"Los campos no puede ir vacio o llevar caracteres especiales",
                        showConfirmButton:true,
                        confirmButtonText:"Cerrar",
                        closenConfirm:false


                }).then((result)=>{

                        if(result.value){
                            window.location="administrador";
                        }

                })
                
                </script>
                ';
            }
        }
    }







    // crear usuario EMPLEADO
    // crear usuario EMPLEADO
    // crear usuario EMPLEADO
    // crear usuario EMPLEADO
    static public  function ctrCrearUsuarioEmpleado()
    {
        if (isset($_POST["nuevoUsuario"])) {
            if (
                preg_match('/^[a-zA-zñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match(
                    '/^[a-zA-z0-9]+$/',
                    $_POST["nuevoUsuario"] &&
                        preg_match('/^[a-zA-z0-9]+$/', $_POST["nuevoPassword"])
                )
            ) {

                $tabla = "usuarios";
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $datos = array(
                    "nombre" => strtoupper($_POST["nuevoNombre"]),
                    "password" =>  $encriptar,
                    "perfil" => $_POST["nuevoPerfil"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "estado" => 1,
                    "id_bodega" => $_POST["id_bodega"]

                );



                $respuesta = ModeloUsuarios::mdlIngresarEmpleado($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '
                    <script>
                    swal({
                            type:"success",
                            title:"Registro correcto",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="empleados";
                            }
    
                    })
                    
                    </script>
                    ';
                } else {

                    echo '
                    <script>
                    swal({
                            type:"error",
                            title:"Datos no insertados",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="empleados";
                            }
    
                    })
                    
                    </script>
                    ';
                }
            } else {

                echo '
                <script>
                swal({
                        type:"error",
                        title:"Los campos no puede ir vacio o llevar caracteres especiales",
                        showConfirmButton:true,
                        confirmButtonText:"Cerrar",
                        closenConfirm:false


                }).then((result)=>{

                        if(result.value){
                            window.location="empleados";
                        }

                })
                
                </script>
                ';
            }
        }
    }









    //mostrar usuarios
    //mostrar usuarios
    //mostrar usuarios
    static public  function ctrMostarUsuarios()
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla);
        return $respuesta;
    }


    //mostrar activos
    //mostrar activos
    //mostrar activos
    static public  function ctrMostarUsuariosActivos()
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuariosActivos($tabla);
        return $respuesta;
    }


    static public function ctrMostrarUsuario($item, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuario($tabla, $item, $valor);
        return $respuesta;
    }





    static public function ctrEditarUsuario()
    {

        if (isset($_POST["editarUsuario"])) {

            $estado1 = false;

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])

            ) {



                $tabla = "usuarios";

                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        $estado1 = true;
                    }
                } else {
                    $encriptar = $_POST["passwordActual"];
                }


                if ($estado1 == false) {
                    $datos = array(
                        "nombre" => strtoupper($_POST["editarNombre"]),
                        "usuarios" => $_POST["editarUsuario"],
                        "perfil" => $_POST["editarPerfil"],
                        "password" => $encriptar
                    );


                    $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                    if ($respuesta == "ok") {
                        echo '
                    <script>
                    swal({
                            type:"success",
                            title:"Actualizado correctamente",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="administrador";
                            }
    
                    })
                    
                    </script>
                    ';
                    } else {


                        echo '
                    <script>
                    swal({
                            type:"error",
                            title:"Datos no modificados",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="administrador";
                            }
    
                    })
                    
                    </script>
                    ';
                    }
                }
            } else {

                $estado1 = true;
            }
            if ($estado1 == true) {
                echo '
                <script>
                swal({
                        type:"error",
                        title:"Ingrese correctamente la información en los campos",
                        showConfirmButton:true,
                        confirmButtonText:"Cerrar",
                        closenConfirm:false


                }).then((result)=>{

                        if(result.value){
                            window.location="administrador";
                        }

                })
                
                </script>
                ';
            }
        }
    }






    //EDITAR EMPLEADO



    static public function ctrEditarEmpleado()
    {

        if (isset($_POST["editarUsuario"])) {

            $estado1 = false;

            if (
                preg_match('/^[a-zA-z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])

            ) {



                $tabla = "usuarios";

                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        $estado1 = true;
                    }
                } else {
                    $encriptar = $_POST["passwordActual"];
                }





                
                if ($estado1 == false) {

                    $datos = array(
                        "nombre" => strtoupper($_POST["editarNombre"]),
                        "usuarios" => $_POST["editarUsuario"],
                        "perfil" => $_POST["editarPerfil"],
                        "password" => $encriptar,
                        "id_bodega" => $_POST["id_bodegaEditar"]
                    );


                    $respuesta = ModeloUsuarios::mdlEditarEmpleado($tabla, $datos);
                    if ($respuesta == "ok") {
                        echo '
                    <script>
                    swal({
                            type:"success",
                            title:"Actualización correcta",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="empleados";
                            }
    
                    })
                    
                    </script>
                    ';
                    } else {


                        echo '
                    <script>
                    swal({
                            type:"error",
                            title:"Erro de actualización",
                            showConfirmButton:true,
                            confirmButtonText:"Cerrar",
                            closenConfirm:false
    
    
                    }).then((result)=>{
    
                            if(result.value){
                                window.location="empleados";
                            }
    
                    })
                    
                    </script>
                    ';
                    }
                }
            } else {

                $estado1 = true;
            }
            if ($estado1 == true) {
                echo '
                <script>
                swal({
                        type:"error",
                        title:"Ingrese conrrectamente la información en los campos",
                        showConfirmButton:true,
                        confirmButtonText:"Cerrar",
                        closenConfirm:false


                }).then((result)=>{

                        if(result.value){
                            window.location="empleados";
                        }

                })
                
                </script>
                ';
            }
        }
    }




    //actualizar perfil

    static public function ctrEditarPerfilUsuario()
    {

        if (isset($_POST["idPerfil"])) {
            $estado = false;

            if (
                preg_match('/^[a-zA-zñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombresPerfil"])
            ) {



                $tabla = "usuarios";

                if ($_POST["nuevaPasswordPerfil"] != "") {

                    if (preg_match('/^[a-zA-z0-9]+$/', $_POST["nuevaPasswordPerfil"])) {

                        $encriptar = crypt($_POST["nuevaPasswordPerfil"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {

                        $estado = true;
                    }
                } else {
                    $encriptar = $_POST["oldPassword"];
                }
                if ($estado == false) {

                    $datos = array(
                        "id" => $_POST["idPerfil"],
                        "nombre" => strtoupper($_POST["nombresPerfil"]),
                        "password" => $encriptar,
                        "email" => $_POST["emailPerfil"],

                    );


                    $respuesta = ModeloUsuarios::mdlEditarPerfil($tabla, $datos);

                    if ($respuesta == "ok") {
                        echo '
                        <script>
                        swal({
                                type:"success",
                                title:"Actualización correcta",
                                showConfirmButton:true,
                                confirmButtonText:"Cerrar",
                                closenConfirm:false
        
        
                        }).then((result)=>{
        
                                if(result.value){
                                    window.location="mi-perfil";
                                }
        
                        })
                        
                        </script>
                        ';
                    } else {


                        echo '
                        <script>
                        swal({
                                type:"error",
                                title:"Error de actualización",
                                showConfirmButton:true,
                                confirmButtonText:"Cerrar",
                                closenConfirm:false
        
        
                        }).then((result)=>{
        
                                if(result.value){
                                    window.location="mi-perfil";
                                }
        
                        })
                        
                        </script>
                        ';
                    }
                }
            } else {

                $estado = true;
            }



            if ($estado == true) {

                echo '
                <script>
                swal({
                        type:"error",
                        title:"Los datos no pueden ser vacíos o llevar caracteres especiales",
                        showConfirmButton:true,
                        confirmButtonText:"Cerrar",
                        closenConfirm:false


                }).then((result)=>{

                        if(result.value){
                            window.location="mi-perfil";
                        }

                })
                
                </script>
                ';
            }
        }
    }
}
