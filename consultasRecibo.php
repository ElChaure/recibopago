<?php
$cedula = $_POST['cedula']; // get the username
$cuenta =$_POST['cuenta'];
$ano =$_POST['ano'];
/*$dbconn = pg_connect("host=10.29.6.32 dbname=talento_humano user=robot password=#c@v3rn1c0l@")
        or die('Could not connect: ' . pg_last_error());*/

if (($_POST['cedula']!='')&&($_POST['cuenta']!='')){
	echo check_nomina($cedula,$cuenta,$ano); 
}

function check_nomina($cedula,$cuenta,$ano){
        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");
	//perform query
	$result = pg_query($dbconn, "SELECT
									 t_d_pago_nomina.id_pago_nomina,
									 t_d_personal.cedula,
									 t_d_nomina.descripcion,
									 t_d_periodo.fecha_inicio,
									 t_d_periodo.fecha_fin,
									 t_d_pago_nomina.total_asig,
									 t_d_pago_nomina.d_total,
									 t_d_pago_nomina.total_cancelar
									FROM
									 t_d_personal
									INNER JOIN  t_d_pago_nomina ON  t_d_pago_nomina.id_persona =  t_d_personal.id_personal
									INNER JOIN  t_d_nomina ON  t_d_pago_nomina.id_nomina =  t_d_nomina.id_nomina
									INNER JOIN  t_d_periodo ON  t_d_pago_nomina.id_periodo =  t_d_periodo.id_periodo
									WHERE
									 t_d_personal.cedula = '".$cedula."' AND
									 t_d_personal.fecha_ingreso='".$cuenta."' AND
									 ano='".$ano."'
									 order by t_d_periodo.fecha_inicio");
	$resultado=pg_fetch_all($result);



	if($resultado===false){

		return '1';


	}else{

		
		return json_encode($resultado);
	}
}

?>
