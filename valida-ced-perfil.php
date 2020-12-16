	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrar Personal</title>
</head>

<body>

<?php
error_reporting(0);
$servidor="10.29.6.32";
$basededatos="gestion_extension";
$usuario="robot";
$clave="#c@v3rn1c0l@";

if(isset($_POST['cedula'])&& !empty($_POST['cedula']))
	{
		
		$con=mysql_connect($servidor,$usuario,$clave) or die ("Error conectando a la base de datos");
		mysql_select_db($basededatos ,$con) or die("Error seleccionando la Base de datos");
			
		$resultado=mysql_query($con="SELECT
									 perfil_personal.cedula
									 FROM
									 perfil_personal
									WHERE
									cedula='$_POST[cedula]'");
		if(mysql_fetch_array($resultado)==true){
		
		
		   
		include ('index2.php');
		}else{

			
			include ('planilla.php');
			
		}
      }
?>

</body>
</html>
