<?php 
	require("../Clases/utilidades.class.php");
	require("../Clases/factura.class.php");
	$objUtilidades = new utilidades();
	$con=$objUtilidades->conectar(); 
	$objFactura = new factura();
	switch($_REQUEST["accion"]) {
		case "html2pdf":
			try {
				$html2pdf = new HTML2PDF('P','A4','fr');
				$html2pdf->WriteHTML($_GET["cod"]);
				$html2pdf->Output('exemple.pdf');
				echo "Bien";
			}
			catch(HTML2PDF_exception $e) {
				echo $e;
				exit;
			}
			break;
			
		case "agregar_factura":
			$res = $objFactura->agregar_factura($con,$_POST["fec_fac"],$_POST["cod_cli"],$_POST["nom_for"],$_POST["subtotal"],$_POST["impuesto"],$_POST["total"]);
			$cont=0;
			$cont2=0;
			for ($i=0;$i<=$_POST["num_filas"];$i++) {
				if(isset($_POST["producto".$i])) {
					$ok=$objFactura->agregar_producto($con,$_POST["cod".$i],$_POST["cantidad".$i],$_POST["precio".$i],$_POST["impuesto"],$_POST["total".$i],$res);
					$cont++;
					if($ok)
						$cont2++;
				}
			}
			$objUtilidades->mensaje($con,$cont==$cont2,"Factura");
			break;
		
		case "listar_facturas":
			$objFactura->listar_facturas($con);	
			break;
		
		case "editar_factura":
			$objFactura->detallar_factura($con,$_GET["num_fac"]);
			break;
			
		case "factura_mas":
			$objFactura->factura_mas_costosa($con);
			break;
		
		case "clientes_fieles":
			$objFactura->clientes_fieles($con);
			break;
		
		case "mejores_clientes":
			$objFactura->mejores_cientes($con);
			break;
		
		case "formas":
			$objFactura->formas_mas_usadas($con);
			break;
			
		case "mas_comprados":
			$objFactura->mas_comprados($con);
			break;
	}
?>