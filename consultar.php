<!DOCTYPE html>
<html lang="es">
<head><title>PLANILLA AR-C</title></head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<body>
<article>
<div align="center" >
<script src="js/jquery.min.js" type="text/javascript"></script>
<?php

//error

        /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	      $query = ("SELECT
t_d_pago_nomina.id_persona,
t_d_pago_nomina.total_asig,
t_d_personal.cedula,
t_d_personal.fecha_ingreso,
t_d_periodo.mes,
t_d_periodo.fecha_inicio,
t_d_periodo.fecha_fin,
t_d_personal.nombres_apellidos,
t_d_cargo.descripcion,
t_d_pago_nomina.bonificacion,
t_d_periodo.ano
FROM
t_d_pago_nomina
INNER JOIN t_d_personal ON t_d_pago_nomina.id_persona = t_d_personal.id_personal
INNER JOIN t_d_periodo ON t_d_pago_nomina.id_periodo = t_d_periodo.id_periodo
INNER JOIN t_d_cargo ON t_d_personal.cargo = t_d_cargo.id_cargo

WHERE
cedula='$_GET[persona]' and fecha_ingreso='$_GET[ingreso]' and ano='$_GET[ano]'
ORDER BY id_quincena");
	      	

	      $result=pg_query($query) 
	      or die ('consulta fallida'.pg_last_error());
			$rows=pg_num_rows($result);
		$dpersona=pg_fetch_all($result);
		$persona=$dpersona[0];	

//ENCABEZADO

$total=0;

echo "<img src='images/barrio_adentro.jpg' align=left width='150px' height='80px'>";
echo "<strong><td>PLANILLA AR-C<br>PERIODO 01-01-2016 AL 31-12</strong></tr><br>";
echo "<td><STRONG>".$persona['nombres_apellidos']."</STRONG></td><br>";
echo "<td><STRONG>".$persona['cedula']."</STRONG><br></td>";
echo "<STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;".$persona['descripcion']."</STRONG><br>";


//tabla de MONTOS Y MESES
echo "<table aling=center cellspacing=2 border =0>\n";
echo "<tr><td><h4>MES<td><h4>PRIMERA<br>QUINCENA<td><h4>SEGUNDA<br>QUINCENA<td><h4>ASIGNACION<td><h4>BONIFICACION</h4></tr>";
	      //mostrar los datos
for($i=1;$i<=$rows; $i++){
$line = pg_fetch_array($result, null, PGSQL_ASSOC);
echo "<tr>";
echo "<td>$line[mes]</td>";
echo "<td>$line[fecha_inicio]</td>";
echo "<td>$line[fecha_fin]</td>";
echo "<td>$line[total_asig]</td>";
echo "<td>$line[bonificacion]</td>";
echo "</tr>";


//SUMATORIA
$total+=$line['total_asig']+$line['bonificacion'];


}


echo "</table>\n";
echo "<hr>";


echo "TOTAL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo number_format($total,2,',','.');


// Free resultset
pg_free_result($result);
// Closing connection
pg_close($dbconn);

      
?>
</div>


</article>
<aside></aside>
<div class="footer">
	<p class="center">Centro Simón Bolívar - Edif. Sur - Portal Municipal - Piso 3  Ofic. 325 - El Silencio Caracas  
- Telfs. (0212) 408.06.63 - Fax: (0212) 408.06.68</p>
    <p></p>

</div>
</body>
<a href='javascript:window.print(); void 0;'>Imprimir</a>
</html>
