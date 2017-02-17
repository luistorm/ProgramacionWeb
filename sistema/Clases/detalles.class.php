<?php
	class detalle
	{
		function agregar_detalle($con,$cod_pro,$can_pro,$pre_pro,$imp_pro,$tot_det) 
		{
			$cod_fac = mysql_insert_id($con);
			echo $cod_fac;
			$cod_fac--;
			$sql = "insert into detalle_factura(num_fac,cod_pro,can_pro,pre_pro,imp_pro,tot_det)
					values ($cod_fac,'$cod_pro',$can_pro,$pre_pro,$imp_pro,$tot_det)";
				echo $sql;
			return mysql_query($sql,$con);
		}	
	}
?>