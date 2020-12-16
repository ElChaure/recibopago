<?php
$username = $_POST['cedula']; // get the username
$account =$_POST['cuenta'];
/*$dbconn = pg_connect("host=10.29.6.32 dbname=talento_humano user=robot password=#c@v3rn1c0l@")
        or die('Could not connect: ' . pg_last_error());*/

if(($_POST['cedula']!='')&&($_POST['cuenta']=='')){

	echo check_username($username); 

}elseif (($_POST['cedula']!='')&&($_POST['cuenta']!='')&&($_POST['cuenta']!='1')&&($_POST['cuenta']!='2')){

	echo check_username_account($username,$account); 

}elseif (($_POST['cedula']!='')&&($_POST['cuenta']=='1')){

	echo obtener_datos($username,$account); 

}elseif (($_POST['cedula']!='')&&($_POST['cuenta']=='2')){

	echo obtener_datos_validacion($username,$account); 

}else{

	ECHO '<span style="color:#0c0">Introduzca una cedula</span>';

}

function check_username($username){
	        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	//perform query
	$result = pg_query($dbconn, "SELECT
										t_d_personal.cedula
										FROM
										t_d_personal
										WHERE
										cedula='".$username."'");
	if(pg_fetch_assoc($result)!=false){
		return '1';

	}else{

		return '<span style="color:#0c0">Número de cédula inválido</span>';
	}
}

function obtener_datos($username,$cuenta){
	        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	//perform query
	$result = pg_query($dbconn, "SELECT
									 t_d_personal.nombres_apellidos,
									 t_d_personal.cedula,
									 t_d_cargo.descripcion as cargo,
									 t_d_nomina.descripcion as nomina
									FROM
									 t_d_personal
									INNER JOIN  t_d_cargo ON  t_d_personal.cargo =  t_d_cargo.id_cargo
									INNER JOIN  t_d_nomina ON  t_d_personal.nomina =  t_d_nomina.id_nomina

										WHERE
										cedula='".$username."'");
	$persona=pg_fetch_all($result);
	return json_encode($persona);
}
function obtener_datos_validacion($username,$cuenta){
	        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	$datosPersona = pg_query($dbconn, "SELECT
										t_d_personal.nombres_apellidos,
										t_n_nacionalidad.inicial,
										t_d_personal.cedula,
										t_d_personal.fecha_ingreso,
										t_d_cargo.descripcion,
										t_d_pago_nomina.sueldo_mensual
										FROM
										t_d_personal
										INNER JOIN  t_n_nacionalidad ON  t_d_personal.id_nacionalidad =  t_n_nacionalidad.id_nacionalidad
										INNER JOIN  t_d_cargo ON  t_d_personal.cargo =  t_d_cargo.id_cargo
										INNER JOIN  t_d_pago_nomina ON  t_d_pago_nomina.id_persona =  t_d_personal.id_personal
										WHERE
										cedula='".$username."' AND
										id_estado_persona='1'
										ORDER BY sueldo_mensual DESC 
										LIMIT 1");
	$dpersona=pg_fetch_all($datosPersona);
	if($dpersona==null){
		return 1;

	}else{

		return json_encode($dpersona);

	}
}

function check_username_account($username,$account){
	        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	//perform query
	$result = pg_query($dbconn, "SELECT
									t_d_personal.cedula,
									t_d_pago_nomina.cuenta
									FROM
									t_d_personal
									INNER JOIN t_d_pago_nomina ON t_d_pago_nomina.id_persona = t_d_personal.id_personal
									WHERE
									cedula='".$username."'
									and fecha_ingreso='".$account."'");

	if(pg_fetch_assoc($result)!=false){
		return '1';


	}else{

		return '<span style="color:#0c0">La fecha ingresada no coincide con la registrada en base de datos</span>';
	}
}
?>
