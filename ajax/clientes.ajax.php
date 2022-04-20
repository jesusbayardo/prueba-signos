<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{





    public function MostrarTabla()
    {


      
        $productos = ControladorClientes::ctrMostrarDatos();

       
        $datosJson = '{
            "data": [';
        for ($i = 0; $i < count($productos); $i++) {

            $datosJson .= '[
                "' . ($i + 1) . '",
                    "' . $productos[$i]["cedula"] . '",
                    "' . $productos[$i]["nombres"] . '",
                    "' . $productos[$i]["fecha_nacimiemto"] . '", 
                    "' . $productos[$i]["edad"] . '", 
                    "' . $productos[$i]["temperatura"] . '", 
                    "' . $productos[$i]["precion_arterial"] . '", 
                    "' . $productos[$i]["pulso"] . '", 
                    "' . $productos[$i]["frecuencia_respiratoria"] . '", 
                    "' . $productos[$i]["saturacion"] . '", 
                    "' . $productos[$i]["peso"] . '", 
                    "' . $productos[$i]["talla"] . '", 
                    "' . $productos[$i]["imc"] . '"
                
                  ],';
        }
        $datosJson = substr($datosJson, 0, -1);
        $datosJson .=   '] 
  
           }';

        echo $datosJson;
    }







}



//activar tabla 
$activarProductos = new AjaxClientes();
$activarProductos->MostrarTabla();
