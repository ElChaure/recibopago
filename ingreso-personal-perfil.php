
<?php
error_reporting(0);
header("Content-Type: text/html;charset=utf-8");
$cedula = $_POST["cedula"];
//echo"cedula:".$cedula."<br>";

$nac = $_POST["nac"];
//echo "Nacionalidad:".$nac."<br>";

 
$nombres=strtoupper($_POST["nombres"]);
//echo $_POST["nombres"];
$nombres2 = strtr($nombres, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$nombres = utf8_decode ($nombres2);
//echo "Nombres:".$nombres."<br>";



$apellidos=strtoupper($_POST["apellidos"]);
//echo $_POST["apellidos"];
$apellidos2 = strtr($apellidos, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$apellidos = utf8_decode ($apellidos2);
//echo "Apellidos:".$apellidos."<br>";

$sexo = $_POST["sexo"];
//echo "Sexo:".$_POST["sexo"]."<br>";

$fechaNac = $_POST["fechaNac"];
//echo "Fehca Nac:".$_POST["fechaNac"]."<br>";

$lugarNac=strtoupper($_POST["lugarNac"]);
$lugarNac2 = strtr($lugarNac, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$lugarNac = utf8_decode ($lugarNac2);
//echo "Lugar Nac:".$lugarNac."<br>";

$edoNac = $_POST["edoNac"];
//echo "Estado Nac:".$_POST["edoNac"]."<br>";

$muniNac=strtoupper($_POST["muniNac"]);
$muniNac2 = strtr($muniNac, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$muniNac = utf8_decode ($muniNac2);
//echo "Municipio Nac:".$muniNac."<br>";

$parroNac=strtoupper($_POST["parroNac"]);
$parroNac2 = strtr($parroNac, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$parroNac = utf8_decode ($parroNac2);
//echo "Parroquia Nac:".$parroNac."<br>";

$civil = $_POST["civil"];

$hijos = $_POST["hijos"];

$vivienda = $_POST["vivienda"];

$telefono = $_POST["telefono"];

$email = $_POST ['email'];
//echo "Estado Civil:".$civil."<br>";
//echo "Hijos:".$hijos."<br>";
//echo "Vivienda:".$vivienda."<br>";
//echo "Telefono:".$telefono."<br>";
//echo "Correo:".$email."<br>";

$direccion=strtoupper($_POST["direccion"]);
$direccion2 = strtr($direccion, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$direccion = utf8_decode ($direccion2);
//echo "Direccion:".$direccion."<br>";


$academico = $_POST["academico"];
//echo "Academico:".$academico."<br>";

$profesion=strtoupper($_POST["profesion"]);
$profesion2 = strtr($profesion, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$profesion = utf8_decode ($profesion2);

//echo "Profesion:".$profesion."<br>";

$fechaFMBA = $_POST["fechaFMBA"];
//echo "fecha FMBA:".$fechaFMBA."<br>";

$cargo = strtoupper($_POST["cargo"]);
$cargo2 = strtr($cargo, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$cargo = utf8_decode ($cargo2);
//echo "Cargo:".$cargo."<br>";

$fechaAP = $_POST["fechaAP"];
//echo "fecha AP".$fechaAP."<br>";

$ncentro=strtoupper($_POST["ncentro"]);
$ncentro2 = strtr($ncentro, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$ncentro = utf8_decode ($ncentro2);
//echo "nombreCentro:".$ncentro."<br>";


$edocentro = $_POST["edocentro"];

$municentro=strtoupper($_POST["municentro"]);
$municentro2 = strtr($municentro, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$municentro = utf8_decode ($municentro2);

//echo "MuniCentro:".$municentro."<br>";

$parrocentro=strtoupper($_POST["parrocentro"]);
$parrocentro2 = strtr($parrocentro, "áéíóúüñ", "ÁÉÍÓÚÜÑ");
$parrocentro = utf8_decode ($parrocentro2);
//echo "ParroCentro:".$parrocentro."<br>";

$host="10.29.6.32";
$db="gestion_extension";
$user="robot";
$pw="#c@v3rn1c0l@";  
    if(isset($_POST['cedula'])&& !empty($_POST['cedula']))
	{
		
		$con=mysqli_connect($host,$user,$pw) or die ("Error conectando a la base de datos");
		mysqli_select_db($con,$db) or die("Error seleccionando la Base de datos");
			
		$resultado=mysqli_query($con,"SELECT
									 'cedula'
									 FROM
									 perfil_personal
									WHERE
									cedula='$cedula'");
		if(mysqli_fetch_array($resultado)==true){
		
		
		 include 'index2.php';
		}else{

	$sql= "INSERT INTO perfil_personal (cedula,nac,nombres,apellidos,sexo,fechaNac,lugarNac,edoNac,muniNac,parroNac,civil,hijos,vivienda,telefono,email,direccion,academico,
	profesion,fecha_fmba,cargo,fecha_admin,centro,edoCentro,muniCentro,parroCentro) 
values ('$cedula','$nac','$nombres','$apellidos','$sexo','$fechaNac','$lugarNac','$edoNac','$muniNac','$parroNac','$civil','$hijos','$vivienda','$telefono','$email','$direccion','$academico','$profesion',
    '$fechaFMBA','$cargo','$fechaAP','$ncentro','$edocentro','$municentro','$parrocentro')";
			
 if(!mysqli_query($con,$sql)){
    die('Error al registrar:'.mysqli_error($con));
 } 

 include ('fin-perfil.php');

			
		}
      }
?>
