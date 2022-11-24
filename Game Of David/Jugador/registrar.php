<?php
include 'header.php';

try{
	$conn =  mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos, 3307);
	if(!$conn){
		echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
	}else{
		
		if(isset($_GET['usuario']) && isset($_GET['pass'])){
			$usuario = $_GET['usuario'];
			$pass = $_GET['pass'];
			$nivel = 1;
			$score = 0;

			$sql = "SELECT * FROM `jugador` WHERE usuario = '".$usuario."'";
			$resultado = $conn->query($sql);
			if ($resultado->num_rows > 0) {
				echo '{"codigo":202,"mensaje":"El usuario existe en el sistema",
					   "respuesta":"'.$resultado->num_rows.'"}';
			}else{
				$sql = "INSERT INTO `jugador` (`id`, `usuario`, `pass`, `nivel`, `score`) 
					VALUES (NULL, '".$usuario."', '".$pass."', '".$nivel."', '".$score."');";

				if ($conn->query($sql) == TRUE) {

					$sql = "SELECT * FROM `jugador` WHERE usuario = '".$usuario."'";
					$resultado = $conn->query($sql);
					$texto = '';

					while($row = $resultado->fetch_assoc()){
						$texto = 
						"{#id#:".$row['id'].
						",#usuario#:#".$row['usuario'].
						"#,#nivel#:".$row['nivel'].
						",#score#:".$row['score'].
						"}";
					} 

					echo '{"codigo":201,"mensaje":"Usuario creado correctamente","respuesta":"'.$texto.'"}';
				}else{
					echo '{"codigo":401,"mensaje":"Error al intentar crear al usuario","respuesta":""}';
				}
			}


			
		}else{
			echo '{"codigo":402,"mensaje":"Faltan datos para crear el usuario","respuesta":""}';
		}
	}
}catch(Exception $e){
	echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
}

include 'footer.php';

?>