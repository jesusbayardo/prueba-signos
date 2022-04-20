<?php
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/bodega.controlador.php";
require_once "../../../modelos/bodega.modelo.php";


require_once "../../../controladores/unidades.controlador.php";
require_once "../../../modelos/unidades.modelo.php";

class imprimirInventario
{

    public $codigo;


    public function traerImpresionInventario()
    {

        $item2 = "id";
        $valor2 = $_GET["inventario"];
        $bodega = Controladorbodegas::ctrMostrarBodega($item2, $valor2);
        $nombreBodega = $bodega["nombre_bodega"];

        $item = "id_bodega";
        $respuesta = Controladorbodegas::ctrMostrarBodegaActivos($item, $valor2);
        $valorTotalBodega = 0;
        foreach ($respuesta as $key1 => $value3) {
            $idProducto1 = $value3["id_producto"];
            $stockProductos1 = $value3["stock"];
            $item2 = "id";
            $productos1 = ControladorProductos::ctrMostrarProducto($item2, $idProducto1);
            $monto = $stockProductos1 * $productos1["precio_venta"];           
            $valorTotalBodega=($valorTotalBodega+ $monto);
            $formatTotal=number_format( $valorTotalBodega,2);
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
			<td style="width:140px"><img src="images/img.png"></td>
			<td style="background-color:white; width:280px">
				<div style="font-size:15.5px; text-align:center; line-height:15px;">
					INVENTARIO $nombreBodega
                    
				</div>
                <div style="font-size:10.5px; text-align:center; line-height:15px;">
					
                    Valor total en bodega: $ $formatTotal
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

	<table style="font-size:7px; padding:5px 10px;">
		<tr>
        <td style="border: 1px solid #666; background-color:white; width:40px;font-weight: bold; text-align:center">#</td>
		<td style="border: 1px solid #666; background-color:white; width:80px;font-weight: bold; text-align:center">Código</td>
		<td style="border: 1px solid #666; background-color:white; width:180;font-weight: bold; text-align:center">Detalle Producto</td>
        <td style="border: 1px solid #666; background-color:white; width:60;font-weight: bold; text-align:center">Unidad</td>
        <td style="border: 1px solid #666; background-color:white; width:58px;font-weight: bold; text-align:center">Precio compra</td>
        <td style="border: 1px solid #666; background-color:white; width:58px;font-weight: bold; text-align:center">Stock</td>
      
        <td style="border: 1px solid #666; background-color:white; width:85px;font-weight: bold; text-align:center"> $ Monto total</td>
		
		</tr>
	</table>
EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

        // ---------------------------------------------------------

        $item = "id_bodega";
        $valor = $_GET["inventario"];
        $respuesta = Controladorbodegas::ctrMostrarBodegaActivos($item, $valor);
        $c = 0;


        $c = 0;
        foreach ($respuesta as $key1 => $value1) {
            $idProducto = $value1["id_producto"];
            $stockProductos = $value1["stock"];
            $item1 = "id";
            $productos = ControladorProductos::ctrMostrarProducto($item1, $idProducto);
            $descripcionProducto = $productos["descripcion"];
            $codigo = $productos["codigo"];
            $idUnidad=$productos["id_unidad"];

            $unidad=ControladorUnidades::ctrMostrarUnidad("id", $idUnidad);
            $descripcionUnidad= $unidad["nombre_unidad"];


            if ($stockProductos <= 10) {
                $stock = "<button class='btn btn-danger btn-xs'>" . $stockProductos . "</button>";
            } else if ($stockProductos > 11 && $stockProductos <= 15) {
                $stock = "<button class='btn btn-warning btn-xs'>" . $stockProductos . "</button>";
            } else {
                $stock = "<button class='btn btn-success btn-xs'>" . $stockProductos . "</button>";
            }
            $monto = number_format($stockProductos * $productos["precio_venta"], 2);
            $preciCompra = number_format($productos["precio_venta"], 2);

            $n = $key1 + 1;

            $bloque4 = <<<EOF
                    <table style="font-size:7px; padding:5px 10px;">
                    <tr>
        
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:40px; text-align:center"> 
                     $n
                     </td>
                     <td style="border: 1px solid #666; color:#333; background-color:white; width:80px; ">
                     $codigo
                     </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:180px; ">
                    $descripcionProducto 
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:60px; ">
                $descripcionUnidad
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:58px; text-align:leff">
                    $preciCompra
                    </td>
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:58px; text-align:leff">
                    $stock
                    </td>
        
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:85px; text-align:center">
                    $monto 
                    </td>
        
        
        
                    
                
        
        
                </tr>
        
            </table>    
           
EOF;

            $pdf->writeHTML($bloque4, false, false, false, false, '');
        }
        $pdf->writeHTML($bloque5, false, false, false, false, '');
        // ---------------------------------------------------------
        //SALIDA DEL ARCHIVO 

        $pdf->Output('Inventario.pdf');
    }
}

$factura = new imprimirInventario();

$factura->traerImpresionInventario();
