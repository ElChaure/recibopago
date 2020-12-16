<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<img src='images/barrio_adentro.jpg' align=left width='200px' height='150px' right= '100px' > 
<title>Planilla AR-C</title>
</head>
<!--última actualizacion 24/01/2017, se agrega style css att: Derwuin flores-->
<style type="text/css">
	*{
		margin: -2px;
		padding-top: 8px;
	}
	body{
	    
		background-position:30px auto; 
		margin-top: 40px;
	}
	form{
		background: #990033;
		width: 400px;
		border:1px solid  #660000;
		border-radius:3px;
		box-shadow: inset 0 0 10px  #000000;
		margin:  230px auto;
	}
	h1{
		text-align: center;
		color: #f0f0f0;
		font-weight: normal;
		font-size: 40px;
		margin: 30px 0px;
		margin-top: 10px;
		margin: auto;
	}
	h3{
		text-align: center;
		color: #f0f0f0;
		font-weight: normal;
		font-size: 18px;
		margin: 30px 0px;
		margin-top: 10px;
		margin: auto;
	}
	input[type=text]{
		margin:5px 30px;
		width: 150px;
		border:5px;
		padding: 10px 15px;
		border-radius: 0px 8px 0px 8px;
		margin-top: 15px;

	}

	select[id=fec] {
	width:300px
	margin: 300px;
	height: 25px;
	right: 60px;
	border:2px solid#232323;
	box-shadow: 0px 2px 0px #000; 
	-moz-box-shadow: 0px 2px 0px #000;
	-webkit-box-shadow:0px 2px 0px #000;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding: 1px 0px 0px 15px;
	}
	input[type=date]{
		margin:5px 30px;
		width: 150px;
		border:5px;
		padding: 10px 15px;
		border-radius: 0px 8px 0px 8px;
	}
/*
	input [type=submit]{
	background:#BDBDBD;
	color:#fff;
	border-radius: 3px;
	font-size-adjust: 14px;
	width: 50px;
	margin:20px auto;
	height: 50px;
	border:1px solid #E6E6E6;
	box-shadow: 0px 2px 0px #000;
	-moz-box-shadow: 0px 2px 0px #000;
	-webkit-box-shadow:0px 2px 0px #000;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	padding-top: 10px;
	*/
	}




</style>
<!--última actualizacion 24/01/2017, se actualiza la posicion y se agrega un maxlength att: Derwuin flores-->
<body> 
<body background="fondo-11.png">
<form action="verificar.php" method="GET" name="formulario.php">
<table width="400" border="0" position="center">
<div align="center"><h1>Ingrese sus Datos</h1>
<!--<div style="text-transform: 30px 10px 15px #000;">-->
<tr>
<td><center><h3>CEDULA:</h3></center></td>
<td><input id="l" type="text" name="persona" placeholder="Cedula de Usuario" maxlength="8" title="Se necesita nombre del Usuario" required></td>
</tr>
<tr>
<td><center><h3>FECHA DE INGRESO:</h3></center></td>
<td><input name="ingreso" type="date" class="datepicker" placeholder='Ingresa año-mes-dia' required="Se necesita la fecha de ingreso"></td>
</tr>
<tr>
<td><center><h3>AÑO:</h3></center></td>
<center>
<td> <select id=fec name="ano">
<!--
   <option value="2015">2015</option> 
   -->
   
   <option value="2016">2016</option> 
   <option value="2017">2017</option> 
   </center>
</select></td>
</tr>
<td><input type="submit" value="Consultar" width="100" /></td>
</tr>
</form>
</body>
</html>
