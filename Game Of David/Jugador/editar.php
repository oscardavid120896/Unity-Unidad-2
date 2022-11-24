<?php
include 'header.php';

try{
	$conn =  mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos, 3307);
	if(!$conn){
		echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
	}else{
		
		if(isset($_POST['usuario']) && isset($_POST['score']) && isset($_POST['nivel'])){

			$usuario = $_POST['usuario'];
			$score = $_POST['score'];
			$nivel = $_POST['nivel'];

			$sql = "UPDATE `jugador` SET `nivel` = '".$nivel."', `score` = '".$score."' WHERE `usuario` = '".$usuario."'; ";

			$conn->query($sql);

			$sql = "SELECT * FROM `jugador` WHERE usuario = '".$usuario."';";
			$resultado = $conn->query($sql);
			if ($resultado->num_rows > 0) {

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

				echo '{"codigo":206,"mensaje":"Nivel y score actualizado correctamente","respuesta":"'.$texto.'"}';
			}else{
				echo '{"codigo":204,"mensaje":"El usuario y/o contraseña incorrectos","respuesta":""}';
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