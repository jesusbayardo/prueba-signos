<?php
session_start();
require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";



require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";



require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

class imprimirFactura
{

    public $codigo;


    public function traerImpresionFactura()
    {

        //TRAEMOS LA INFORMACIÓN DE LA VENTA
        $valor=$_SESSION["id"];
        $item="id";

      $Usuarios=ControladorUsuarios::ctrMostrarUsuario($item, $valor);
      $vendedor=$Usuarios["nombre"];

        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
        
        
        
        foreach ($respuesta as $key1 => $value1) {
            $id_vendedor = $value1["id_vendedor"];
            
            $itemCliente = "id";           
            $respuestaUsuarios = ControladorUsuarios::ctrMostrarUsuario($itemCliente, $id_vendedor);      
            $nombresUsuario= $respuestaUsuarios["nombre"];



            $valorVentaa = 0;
            $valorCredito = 0;
            $valorEfectivo = 0;
            foreach ($respuesta as $key1 => $value1) {
                if ($value1["estado"]==0) {
                    if ($_GET["vdtegdow"] == $value1["id_vendedor"]) {
                        $valorVentaa = ($valorVentaa + $value1["total_pagar"]);
                    }
    
                    if ($_GET["vdtegdow"] == $value1["id_vendedor"] && $value1["metodo_pago"]=="Credito") {
                         $valorCredito = ( $valorCredito + $value1["total_pagar"]);
                    }
    
                    if ($_GET["vdtegdow"] == $value1["id_vendedor"] && $value1["metodo_pago"]=="Efectivo") {
                        $valorEfectivo = ( $valorEfectivo + $value1["total_pagar"]);
                   }
    
                }
            }
    
            $valorVentaaredondeado=number_format($valorVentaa,2);
            $valorCreditoRedondeado=number_format($valorCredito,2);
            $valorEfectivoRedondeado=number_format($valorEfectivo,2);

        }
        
        
        //REQUERIMOS LA CLASE TCPDF
        require_once('tcpdf_include.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->startPageGroup();
        $pdf->AddPage();


        // ---------------------------------------------------------

        $bloque1 = <<<EOF
       	<table>
		<tr>
        <br><br>
			<td style="width:120px"><img src="images/img.png"></td>
			<td style="background-color:white; width:280px">
				<div style="font-size:15.5px; text-align:center; line-height:15px;">
					MIS VENTAS
				</div>

                <div style="font-size:8px; text-align:center; line-height:15px;">
             Nombre vendedor :  $vendedor  <br>
					 DESDE  $fechaInicial HASTA $fechaFinal

   </div>
   
   <div style="font-size:8px; text-align:center; ">
					
   Venta Efectivo:    $valorEfectivoRedondeado <br>
     Venta Crédito:    $valorCreditoRedondeado<br>
        Total venta :    $valorVentaaredondeado<br>
</div>
              
			</td>
		</tr>
	</table>

EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');
        // ---------------------------------------------------------
        $bloque2 = <<<EOF
	<table>		
		<tr>			
			<td style="width:540px"><img src="images/back.jpg"></td>		
		</tr>
	</table>

EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');
      

        $bloque5 = <<<EOF
        


EOF;



        // ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:8px; padding:5px 10px;">
		<tr>
        <td style="border: 1px solid #666; background-color:white; width:35px;font-weight: bold; text-align:center">#</td>
		<td style="border: 1px solid #666; background-color:white; width:70px;font-weight: bold; text-align:center">Cód. venta</td>
		<td style="border: 1px solid #666; background-color:white; width:165px;font-weight: bold; text-align:center">Cliente</td>
        <td style="border: 1px solid #666; background-color:white; width:60px;font-weight: bold; text-align:center">Pago</td>
        <td style="border: 1px solid #666; background-color:white; width:70px;font-weight: bold; text-align:center">Venta</td>
        <td style="border: 1px solid #666; background-color:white; width:75px;font-weight: bold; text-align:center">Venta Total</td>
		<td style="border: 1px solid #666; background-color:white; width:75px;font-weight: bold; text-align:center">Fecha venta</td>
		</tr>
	</table>
EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------

        $sum = 0;

        foreach ($respuesta as $key1 => $value1) {
            $id_vendedor = $value1["id_vendedor"];
            $id_cliente = $value1["id_cliente"];
            $Factura = $value1["codigo"];
            $valorVenta =  Number_format($value1["total_pagar"], 2);
            $fecha = $value1["fecha"];
            $itemCliente = "id";
            $item = "id";
            $respuestaUsuarios = ControladorUsuarios::ctrMostrarUsuario($itemCliente, $id_vendedor);



            if ($value1["tipo_venta"] == "ventacredito") {
                $tipoFactura="CRÉDITO";
              } else {

                $tipoFactura= "EFECTIVO";
              }





              $tipoVentaInicial = $value1["tipo_venta"];


              if ($tipoVentaInicial == "ventacredito") {
                 $ventaTipo="CRÉDITO";
              } else if ($tipoVentaInicial == "ventamayor") {
                 $ventaTipo="MAYORISTA";
              } else if ($tipoVentaInicial == "ventamenor") {
                 $ventaTipo="MINORISTA";
              }


            $respuestaClientes = ControladorClientes::ctrMostrarClientes($item, $id_cliente);
            if ($respuestaUsuarios != false) {
                if ($_GET["vdtegdow"] == $respuestaUsuarios["id"] && $value1["estado"] == 0) {
                    $sum = $sum + 1;
                    $bloque4 = <<<EOF
                    <table style="font-size:7.5px; padding:5px 10px;">
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:35px; text-align:center"> 
                     $sum
                     </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:70px; ">
                    $Factura 
                    </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:165px; text-align:center">
                    $respuestaClientes[nombre]
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
                    $tipoFactura
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">
                    $ventaTipo
                    </td>
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $valorVenta 
                    </td>
        
        
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:75px; text-align:center">
                    $fecha 
                    </td>
                
        
        
                </tr>
        
            </table>    
           
EOF;

                    $pdf->writeHTML($bloque4, false, false, false, false, '');
                }
            }
        }
        $pdf->writeHTML($bloque5, false, false, false, false, '');
        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 
      
        $pdf->Output('mis-ventas.pdf');
    }
}

$factura = new imprimirFactura();

$factura->traerImpresionFactura();
