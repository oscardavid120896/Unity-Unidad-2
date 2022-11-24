<?php
include 'header.php';

try{
	$conn =  mysqli_connect($db_servidor, $db_usuario, $db_pass, $db_baseDatos, 3307);
	if(!$conn){
		echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
	}else{
		echo '{"codigo":200,"mensaje":"Conectado correctamente","respuesta":""}';
	}
}catch(Exception $e){
	echo '{"codigo":400,"mensaje":"Error al intentar conectar","respuesta":""}';
}

include 'footer.php';
?>