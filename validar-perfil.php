<?php

error_reporting(0);
$cedula = $_POST['cedula'];

	        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");
	//perform query CONSULTA EL LA TABLA DE PERSONAL ACTIVO
	$result = pg_query($dbconn, "SELECT	t_d_personal.cedula	FROM t_d_personal WHERE	cedula='$cedula'");
	if(pg_fetch_assoc($result) == true){

		
		include ('valida-ced-perfil.php');

	}else{

		echo "ES POSIBLE QUE USTED NO LABORE EN ESTA INSTITUCION";
		
	}


	
?>
