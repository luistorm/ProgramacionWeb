<?php
	session_start();
	if(isset($_GET["tecla"])){
		$matriz=$_SESSION["matriz"];
		$mov=false;
		if($_GET["tecla"]==37){//Muevo izquierda
			for ($k=0; $k < 4; $k++) { 
				for ($i=0; $i < 4; $i++) { 
					for ($j=0; $j < 4; $j++) { 
						if(($j+1)<=3 && $matriz[$i][$j+1]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i][$j+1];
							$matriz[$i][$j+1]=0;
							$mov=true;
						}
					}
				}
			}
			for ($i=0; $i < 4; $i++) { 
				for ($j=0; $j < 4; $j++) { 
					if(($j+1)<=3 && $matriz[$i][$j+1]==$matriz[$i][$j]){
						$matriz[$i][$j+1]=2*$matriz[$i][$j+1];
						$_SESSION["puntos"]=$_SESSION["puntos"]+$matriz[$i][$j+1];
						$matriz[$i][$j]=0;
					}
				}
			}
			for ($k=0; $k < 4; $k++) { 
				for ($i=0; $i < 4; $i++) { 
					for ($j=0; $j < 4; $j++) { 
						if(($j+1)<=3 && $matriz[$i][$j+1]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i][$j+1];
							$matriz[$i][$j+1]=0;
						}
					}
				}
			}
		}
		if($_GET["tecla"]==39){//Muevo derecha
			for ($k=0; $k < 4; $k++) { 
				for ($i=0; $i < 4; $i++) { 
					for ($j=3; $j >= 0; $j--) { 
						if(($j-1)>=0 && $matriz[$i][$j-1]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i][$j-1];
							$matriz[$i][$j-1]=0;
							$mov=true;
						}
					}
				}
			}
			for ($i=0; $i < 4; $i++) { 
				for ($j=0; $j < 4; $j++) { 
					if(($j-1)>=0 && $matriz[$i][$j-1]==$matriz[$i][$j]){
						$matriz[$i][$j-1]=2*$matriz[$i][$j-1];
						$_SESSION["puntos"]=$_SESSION["puntos"]+$matriz[$i][$j-1];
						$matriz[$i][$j]=0;
					}
				}
			}
			for ($k=0; $k < 4; $k++) { 
				for ($i=0; $i < 4; $i++) { 
					for ($j=3; $j >= 0; $j--) { 
						if(($j-1)>=0 && $matriz[$i][$j-1]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i][$j-1];
							$matriz[$i][$j-1]=0;
						}
					}
				}
			}
		}
		if($_GET["tecla"]==38){//Muevo arriba
			for ($k=0; $k < 4; $k++) { 
				for ($j=0; $j < 4; $j++) { 
					for ($i=0; $i < 4; $i++) { 
						if(($i+1)<4 && $matriz[$i+1][$j]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i+1][$j];
							$matriz[$i+1][$j]=0;
							$mov=true;
						}
					}
				}
			}
			for ($j=0; $j < 4; $j++) { 
				for ($i=0; $i < 4; $i++) { 
					if(($i+1)<4 && $matriz[$i+1][$j]==$matriz[$i][$j]){
						$matriz[$i+1][$j]=2*$matriz[$i+1][$j];
						$_SESSION["puntos"]=$_SESSION["puntos"]+$matriz[$i+1][$j];
						$matriz[$i][$j]=0;
					}
				}
			}
			for ($k=0; $k < 4; $k++) { 
				for ($j=0; $j < 4; $j++) { 
					for ($i=0; $i < 4; $i++) { 
						if(($i+1)<4 && $matriz[$i+1][$j]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i+1][$j];
							$matriz[$i+1][$j]=0;
						}
					}
				}
			}
		}
		if($_GET["tecla"]==40){//Muevo abajo
			for ($k=0; $k < 4; $k++) { 
				for ($j=0; $j < 4; $j++) { 
					for ($i=3; $i >= 0; $i--) { 
						if(($i-1)>=0 && $matriz[$i-1][$j]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i-1][$j];
							$matriz[$i-1][$j]=0;
							$mov=true;
						}
					}
				}
			}
			for ($j=0; $j < 4; $j++) { 
				for ($i=3; $i >= 0; $i--) { 
					if(($i-1)>=0 && $matriz[$i-1][$j]==$matriz[$i][$j]){
						$matriz[$i-1][$j]=2*$matriz[$i-1][$j];
						$_SESSION["puntos"]=$_SESSION["puntos"]+$matriz[$i-1][$j];
						$matriz[$i][$j]=0;
					}
				}
			}
			for ($k=0; $k < 4; $k++) { 
				for ($j=0; $j < 4; $j++) { 
					for ($i=3; $i >= 0; $i--) { 
						if(($i-1)>=0 && $matriz[$i-1][$j]!=0 && $matriz[$i][$j]==0){
							$matriz[$i][$j]=$matriz[$i-1][$j];
							$matriz[$i-1][$j]=0;
						}
					}
				}
			}
		}
		if($mov==true){
			$b=false;
			while($b==false){
				$i=rand(0,3);
				$j=rand(0,3);
				$v=rand(0,1);
				if($v==0 && $matriz[$i][$j]==0){
					$matriz[$i][$j]=2;
					$b=true;
				}
				else if($matriz[$i][$j]==0){
					$matriz[$i][$j]=4;
					$b=true;
				}
				$b2=false;
				for($k=0;$k<4;$k++){
					for($l=0;$l<4;$l++){
						if($matriz[$k][$l]==0){
							$b2=true;
							break;
						}
					}
					if($b2==true)
						break;
				}
				if($b2==false){
					break;
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
	<title>2048</title>
	<style type="text/css">
		.casilla{
			background: white;
			color: #443321;
			height: 30px;
			width: 30px;
		}
	</style>
	<script type="text/javascript">
		window.onload=function(){
			document.onkeyup=Teclear;
		}
		function Refresh(){
			document.location="index.php?rwd=1";
		}
		function Teclear(evObject){
			var Tecla=evObject.keyCode;
			document.location="index.php?tecla="+Tecla;
		}
	</script>
</head>
<body>
	<input type = "submit" value = "Juego Nuevo" id = "JuegoNuevo" onclick="Refresh()">
	<?php
		if(isset($_GET["rwd"])){
			unset($_SESSION["matriz"]);
			unset($_SESSION["puntos"]);
		}
		if(isset($_SESSION["matriz"])){
			$matriz = $_SESSION["matriz"];
		}else{
			for($i=0;$i<4;$i++){
				for($j=0;$j<4;$j++){
					$matriz[$i][$j] = 0;
				}
			}	
			$i=rand(0,3);
			$j=rand(0,3);
			$v=rand(0,1);
			if($v==0)
				$matriz[$i][$j]=2;
			else
				$matriz[$i][$j]=4;
			$i=rand(0,3);
			$j=rand(0,3);
			$v=rand(0,1);
			if($v==0)
				$matriz[$i][$j]=2;
			else
				$matriz[$i][$j]=4;
			$_SESSION["matriz"]=$matriz;
			$_SESSION["puntos"]=0;
		}
	?>
	<table>
		<?php
			for ($i=0; $i < 4; $i++) { 
				echo "<tr>";
				for ($j=0; $j < 4; $j++) { 
					echo "<td><input class='casilla' value='".$matriz[$i][$j]."'></td>";
				}
				echo "</tr>";
			}
		?>
	</table>
	<?php
		echo "Puntos: ".$_SESSION["puntos"];
	?>
</body>
</html>