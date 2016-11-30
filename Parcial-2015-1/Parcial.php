<?php
	session_start();
	if(isset($_GET["coordenada"])){
		$tokens=explode(",", $_GET["coordenada"]);//$tokens[0] es fila y $tokens[1] es columna
		$matriz=$_SESSION["matriz"];
		$valor=$matriz[$tokens[0]][$tokens[1]];
		$inicio=$tokens[0]+1;
		$eliminado=false;
		$cantPelotas=0;
		for ($i=$inicio; $i < 10; $i++) { 
			if($matriz[$i][$tokens[1]]==$valor){
				$matriz[$i][$tokens[1]]=0;
				$cantPelotas=$cantPelotas+1;
				$eliminado=true;
			}
			else{
				break;
			}
		}
		$inicio=$tokens[0]-1;
		for ($i=$inicio; $i >= 0; $i--) { 
			if($matriz[$i][$tokens[1]]==$valor){
				$matriz[$i][$tokens[1]]=0;
				$cantPelotas=$cantPelotas+1;
				$eliminado=true;
			}
			else{
				break;
			}
		}
		$inicio=$tokens[1]+1;
		for ($j=$inicio; $j < 10; $j++) { 
			if($matriz[$tokens[0]][$j]==$valor){
				$matriz[$tokens[0]][$j]=0;
				$cantPelotas=$cantPelotas+1;
				$eliminado=true;
			}
			else{
				break;
			}
		}
		$inicio=$tokens[1]-1;
		for ($j=$inicio; $j >= 0; $j--) { 
			if($matriz[$tokens[0]][$j]==$valor){
				$matriz[$tokens[0]][$j]=0;
				$cantPelotas=$cantPelotas+1;
				$eliminado=true;
			}
			else{
				break;
			}
		}
		if($eliminado==true){
			$matriz[$tokens[0]][$tokens[1]]=0;
			$_SESSION["puntos"]=$_SESSION["puntos"]+$cantPelotas;
			for ($k=0; $k < 10; $k++) { 
				for ($j=0; $j < 10; $j++) { 
					for ($i=9; $i >= 0; $i--) { 
						$v=$i-1;
						if($v>=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$v][$j];
							$matriz[$v][$j]=0;
						}
					}
				}
			}
			$c=0;
			for ($k=0; $k < 10; $k++) { 
				for ($j=0; $j < 10; $j++) {
					$c=0; 
					for ($i=0; $i < 10; $i++) { 
						if($matriz[$i][$j]==0){
							$c=$c+1;
						}	
					}
					if($c==10){
						for ($i=0; $i < 10; $i++) { 
							if(($j-1)>=0){
								$matriz[$i][$j]=$matriz[$i][$j-1];
								$matriz[$i][$j-1]=0;
							}
						}
					}
				}
			}
		}
		$_SESSION["matriz"]=$matriz;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Parcial 2015-1</title>
</head>
<body>
	<script type="text/javascript">
		function Refresh(){
			document.location="Parcial.php?rwd=1";
		}
		function Presionar(y,x){
			document.location="Parcial.php?coordenada="+y+","+x;
		}
	</script>
	<input type = "submit" value = "Juego Nuevo" id = "JuegoNuevo" onclick="Refresh()">
	<?php
		if(isset($_GET["rwd"])){
			unset($_SESSION["matriz"]);
			unset($_SESSION["puntos"]);
		}
		if(isset($_SESSION["matriz"])){
			$matriz = $_SESSION["matriz"];
		}else{
			for($i=0;$i<10;$i++){
				for($j=0;$j<10;$j++){
					$matriz[$i][$j] = rand(1,6);
				}
			}	
			$_SESSION["matriz"]=$matriz;
			$_SESSION["puntos"]=0;
		}
	?>
	<table>
		<?php
			for($i=0;$i<10;$i++){
				echo "<tr>";
				for($j=0;$j<10;$j++){
					echo "<td><img onclick='Presionar($i,$j)' src = 'Imagenes/b".$matriz[$i][$j].".jpg' /></td>";
				}
				echo "</tr>";
			}
			
		?>
	</table>
	<?php
		echo "<br/> Puntos ".$_SESSION["puntos"];
	?>
</body>
</html>