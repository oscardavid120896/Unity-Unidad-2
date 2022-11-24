<?php
include 'header.php';

try{
	$conn =  mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos, 3307);
	if(!$conn){
		echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
	}else{
		
		if(isset($_GET['usuario'])){

			$usuario = $_GET['usuario'];

			$sql = "SELECT * FROM `jugador` WHERE usuario = '".$usuario."'";
			$resultado = $conn->query($sql);
			if ($resultado->num_rows > 0) {
				echo '{"codigo":202,"mensaje":"El usuario existe en el sistema",
					   "respuesta":"'.$resultado->num_rows.'"}';
			}else{
				echo '{"codigo":203,"mensaje":"El usuario no existe","respuesta":"0"}';
			}
		}else{
			echo '{"codigo":402,"mensaje":"Faltan datos para verificar usuario","respuesta":""}';
		}
	}
}catch(Exception $e){
	echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
}

include 'footer.php';

?>