<?php
$nomina = $_GET['id_nomina'];
/*$dbconn = pg_connect("host=10.29.6.32 dbname=talento_humano user=root password=123456")
        or die('Could not connect: ' . pg_last_error());*/

	/*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

	//perform query
	$datosPersona = pg_query($dbconn, "SELECT
									 t_d_personal.cedula,
									 t_d_personal.fecha_ingreso,
									 t_d_pago_nomina.cuenta,
									 t_d_pago_nomina.total_asig as tota_asignado,
									 t_d_pago_nomina.total_cancelar,
									 t_d_personal.nombres_apellidos,
									 t_d_pago_nomina.total_cancelar,
									 t_d_nomina.descripcion AS nomina,
									 t_d_periodo.fecha_inicio,
									 t_d_periodo.fecha_fin,
									 t_d_cargo.descripcion as cargo,
									 t_d_pago_nomina.d_total
									FROM
									 t_d_pago_nomina
									INNER JOIN  t_d_personal ON  t_d_pago_nomina.id_persona =  t_d_personal.id_personal
									INNER JOIN  t_d_nomina ON  t_d_pago_nomina.id_nomina =  t_d_nomina.id_nomina
									INNER JOIN  t_d_periodo ON  t_d_pago_nomina.id_periodo =  t_d_periodo.id_periodo
									INNER JOIN  t_d_cargo ON  t_d_personal.cargo =  t_d_cargo.id_cargo
									WHERE
									 t_d_pago_nomina.id_pago_nomina = '".$nomina."'");
	$dpersona=pg_fetch_all($datosPersona);
	$persona=$dpersona[0];

	$asignacion = pg_query($dbconn, "SELECT
									 t_d_pago_nomina.sueldo_quincenal,
									 t_d_pago_nomina.diferencia_salarial,
									 t_d_pago_nomina.retroactivo,
									 t_d_pago_nomina.dia_adicional_mes as dia_adicional_del_mes_clausula_28,
									 t_d_pago_nomina.bono_moto,
									 t_d_pago_nomina.bono_transporte,
									 t_d_pago_nomina.prima_antiguedad,
									 t_d_pago_nomina.prima_profesional,
									 t_d_pago_nomina.monto_evaluacion,
									 t_d_pago_nomina.compensacion,
									 t_d_pago_nomina.prima_dedica_salud as prima_dedicacion_a_la_salud,
									 t_d_pago_nomina.prima_sector_clausula_56 as prima_del_sector_publico_clausula_56,
									 t_d_pago_nomina.prima_medicos_espe as prima_medicos_especialista,
									 t_d_pago_nomina.prima_sector_salud_personal_medico,
									 t_d_pago_nomina.prima_hijo,
									 t_d_pago_nomina.bono_vacacional,
									 t_d_pago_nomina.pago_extraordinarios,
									 t_d_pago_nomina.pago_extraord_rezagados as pagos_extraordinario_rezagados,
									 t_d_pago_nomina.pago_extraordinario_nov,
									 t_d_pago_nomina.pago_extraordinario_dic,
									 t_d_pago_nomina.retroactivo_complemento_sueldo,
									 t_d_pago_nomina.complemento_sueldo,
 									 t_d_pago_nomina.prima_sustitutiva,
									 t_d_pago_nomina.evaluacion_enero_julio,

									 t_d_pago_nomina.prima_responsabilidad,
									 t_d_pago_nomina.prima_jerarquia,
									 t_d_pago_nomina.ajuste_fmba_99,
									 t_d_pago_nomina.incre_fmba_99 as incremento_fmba_99,
									 t_d_pago_nomina.otros_complem_fmba as otros_complementos_fmba,
									 t_d_pago_nomina.evaluacion_julio_diciembre,
									 t_d_pago_nomina.evaluaciones_anteriores,
									 t_d_pago_nomina.reintegro_desc_indebido as reintegro_descuento_indebido,
									 t_d_pago_nomina.prima_uniforme_clausula_35 as prima_uniforme_clausula_35,
									 
									  t_d_pago_nomina.salario_quincenal as salario_quincenal,
									 t_d_pago_nomina.diferencia_sueldo as diferencia_sueldo,
									 t_d_pago_nomina.diferencia_antiguedad as diferencia_prima_de_antiguedad,
									 t_d_pago_nomina.diferencia_profesionalizacion as diferencia_prima_de_profesionalizacion,
									 t_d_pago_nomina.retroactivo_evaluacion as retroactivo_de_evaluacion,
									 t_d_pago_nomina.retroactivo_compensacion as retroactivo_compensacion,
									 t_d_pago_nomina.guardias_nocturnas as guardias_nocturnas,
									 t_d_pago_nomina.domingos as domingos,
									 t_d_pago_nomina.feriados as feriados,
									 t_d_pago_nomina.retroactivo_guardias_nocturnas as retroactivo_de_guardias_nocturnas,
									 t_d_pago_nomina.retroactivo_dom_fer as retroactivo_de_domingos_feriados,
									 t_d_pago_nomina.diferencia_bono_vac as diferencia_bono_vacacional,
									 t_d_pago_nomina.aumento_1era_quincena as aumento_1era_quincena,
									 t_d_pago_nomina.aumento_2da_quincena as aumento_2da_quincena,
									 t_d_pago_nomina.contribucion_nacimiento as clausula_32_contribucion_nacimiento,
									 t_d_pago_nomina.contribucion_matrimonio as clausula_33_contribucion_matrimonio,
									 t_d_pago_nomina.gastos_medicos as clausula_37_gastos_medicos,
									 t_d_pago_nomina.gastos_odontologicos as clausula_38_gastos_odontologicos,
									  t_d_pago_nomina.protesis as clausula_27_protesis,
									  t_d_pago_nomina.utiles as clausula_29_utiles,
									  t_d_pago_nomina.becas as clausula_31_becas,
									  t_d_pago_nomina.juguetes as clausula_45_juguetes,
									  t_d_pago_nomina.servicios_funerarios as clausula_43_servicios_funerarios,
									 t_d_pago_nomina.rezagados_dom_fer_laborados as rezagados_dom_y_fer_laborados,

									 t_d_pago_nomina.prima_alimenta_medico as prima_de_alimentacion_medico,
									 t_d_pago_nomina.prima_alimenta_medico_guardia as prima_de_alimentacion_medico_por_guardia,
									 t_d_pago_nomina.prima_profesional_medico_guardia as prima_profesional_medico_por_guardia,
									 t_d_pago_nomina.guardias_nocturnas_medico as guardias_nocturnas_medico,
									 t_d_pago_nomina.domingos_feriados_medico as domingos_y_feriados_medico,
									 t_d_pago_nomina.retroactivo_de_guardias as retroactivo_de_guardias,

									  
									 bono_nocturno_guardias,
									 domingos_laborados,
									 feriados_laborados,
									 rezagados_bono_nocturno_guardias,
									 rezagados_domingos_laborados,
									 rezagados_feriados_laborados,
									 retroactivo_prima_prof,
									 retroactivo_prima_antig,
									 retroactivo_bono_noct,
									 retroactivo_domingos_feriados,
									 retroactivo_bono_vac,
									 retroactivo_bonificacion_fin_ano 

									FROM
									 t_d_pago_nomina

									WHERE
									 t_d_pago_nomina.id_pago_nomina = '".$nomina."'");
	$asignaResulta=pg_fetch_all($asignacion);
	$asignaConteo=count($asignaResulta[0]);
	$asignaR=$asignaResulta[0];
	foreach ($asignaR as $key => $value) {
		if(($value!=null)&&($value!=0)){
			$asignaRNuevo[$key]=$value;
		}
		
	}

	$deduccion = pg_query($dbconn, "SELECT
									 t_d_pago_nomina.d_sso as sso,
									 t_d_pago_nomina.d_pie as pie,
									 t_d_pago_nomina.d_faov as faov,
									 t_d_pago_nomina.d_pension_aliment as pension_alimentaria,
									 t_d_pago_nomina.fondo_jubilaciones_pensiones as fondo_jubilaciones_pensiones,
									 t_d_pago_nomina.d_otras_deducc as otras_deducciones,
									 t_d_pago_nomina.d_desc_cobro_inde as decuento_por_cobro_indebido,
									 t_d_pago_nomina.descuento_sindical as descuento_sindical


									FROM
									 t_d_pago_nomina
									INNER JOIN  t_d_personal ON  t_d_pago_nomina.id_persona =  t_d_personal.id_personal
									INNER JOIN  t_d_nomina ON  t_d_pago_nomina.id_nomina =  t_d_nomina.id_nomina
									INNER JOIN  t_d_periodo ON  t_d_pago_nomina.id_periodo =  t_d_periodo.id_periodo
									INNER JOIN  t_d_cargo ON  t_d_personal.cargo =  t_d_cargo.id_cargo
									WHERE
									 t_d_pago_nomina.id_pago_nomina = '".$nomina."'");
	$deducResult=pg_fetch_all($deduccion);
	$deducConteo=count($deducResult[0]);
	$deducR=$deducResult[0];
	foreach ($deducR as $key => $value) {
		if(($value!=null)&&($value!=0)){
			$deducRNuevo[$key]=$value;
		}
		
	}
	


include('mpdf/mpdf.php');
	
	$html="<table align='center'  style='border-collapse: collapse;' width='100%' >";
		$html.="<style>td{font-family:arial; font-size:10px;}  .titulos{font-size:14px;}</style>";
		$html.="<tr>";
				$html.="<td  width='227px'>";
						$html.="<img src='images/CINTILLO BARRIO AFUERA.png' width='750px' height='100x'>";
				$html.="</td>";
		$html.="</tr>";
		$html.="<tr>";
				$html.="<td align='center' width='227px'>";
						$html.="<strong>COMPROBANTE DE PAGO<BR></strong>Periodo: ".$persona['fecha_inicio'].' - '.$persona['fecha_fin']."<br>".$persona['nomina']."";
				
				$html.="</td>";
		$html.="</tr>";
		$html.="</table>";
				$html.="<table align='center' style='border-collapse: collapse;' width='100%' >";
		
		$html.="<tr>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid; '>";
						$html.="Apellidos y Nombres:";
				$html.="</td>";
				$html.="<td class='titulos' align='center' width='227px' style='border-top:1px solid;'>";
						$html.="Cedula:";
				$html.="</td>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid;'>";
						$html.="Cargo";
				$html.="</td>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid;'>";
						$html.="Fecha de Ingreso";
				$html.="</td>";
		$html.="</tr>";
		$html.="<tr>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid;'>";
						$html.=$persona['nombres_apellidos'];
				$html.="</td>";
				$html.="<td class='titulos' align='center' width='227px' style='border-top:1px solid;'>";
						$html.=$persona['cedula'];
				$html.="</td>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid;'> ";
						$html.=$persona['cargo'];
				$html.="</td>";
				$html.="<td class='titulos' width='227px' style='border-top:1px solid;'>";
						$html.=$persona['fecha_ingreso'];
				$html.="</td>";
		$html.="</tr>";

	$html.="</table>";

	$html.="<br><br>";

		$html.="<div style='float:left;'>";
			$html.="<table width='50%'  style='border-collapse: collapse;'>";
				
					$html.="<tr>";
							$html.="<td width='113,5px' style='border-top:1px solid; border-bottom:1px solid;'>";
									$html.="DENOMINACIÓN";
							$html.="</td>";
							$html.="<td align='center' width='113,5px' style='border-top:1px solid; border-bottom:1px solid;'>";
									$html.="ASIGNACIÓN";
							$html.="</td>";


					$html.="</tr>";
					foreach ($asignaRNuevo as $key => $value) {
						
						$html.="<tr>";

									$html.="<td width='113,5px' >";
											$html.=strtoupper(str_replace('_',' ',$key));
									$html.="</td>";
									$html.="<td align='right' width='113,5px' >";
											$html.=number_format((float)$value, 2, ',', '.');
									$html.="</td>";


						$html.="</tr>";

					}
				$html.="</table>";
			$html.="</div>";
			$html.="<div style='float:left;position:absolute; left:400px;'>";
				$html.="<table width='92%' style='border-collapse: collapse;'>";
					$html.="<tr>";
							$html.="<td width='113,5px' style='border-top:1px solid; border-bottom:1px solid;'>";
									$html.="DENOMINACIÓN";
							$html.="</td>";
							$html.="<td align='center' width='113,5px' style='border-top:1px solid; border-bottom:1px solid;'>";
									$html.="DEDUCCIÓN";
							$html.="</td>";


					$html.="</tr>";
					
					foreach ($deducRNuevo as $key => $value) {
						
						$html.="<tr>";

									$html.="<td width='113,5px' >";
											$html.=strtoupper(str_replace('_',' ',$key));
									$html.="</td>";
									$html.="<td align='right' width='113,5px' >";
											$html.=number_format((float)$value, 2, ',', '.');
									$html.="</td>";

						$html.="</tr>";

					}
				$html.="</table>";
			$html.="</div>";
			$html.="<br><br>";
				$html.="<table align='center' style='border-collapse: collapse;' width='100%' >";
				
				$html.="<tr>";
						$html.="<td width='227px' style='border-top:1px solid; font-size:16px !important; '>";
								$html.="<strong>Total Ingresos Bs.</strong>";
						$html.="</td>";
						$html.="<td align='center' width='227px' style='border-top:1px solid; font-size:16px !important;'>";
								$html.=number_format((float)$persona['tota_asignado'], 2, ',', '.');
						$html.="</td>";
						$html.="<td width='227px' style='border-top:1px solid; font-size:16px !important;'>";
								$html.="<strong>Total Deducciones Bs.</strong>";
						$html.="</td>";
						$html.="<td align='center' width='227px' style='border-top:1px solid; font-size:16px !important;'>";
								$html.=number_format((float)$persona['d_total'], 2, ',', '.');
						$html.="</td>";
				$html.="</tr>";
				$html.="<tr>";
						$html.="<td width='227px' style='border-top:1px solid; font-size:16px !important;' colspan='2'>";
								$html.="<strong>Cuenta Bancaria: </strong>".$persona['cuenta'];
						$html.="</td>";
						$html.="<td  width='227px' align='right' style='border-top:1px solid; font-size:16px !important;' colspan='2'>";
								$html.="<strong>Neto a Cobrar: </strong>".number_format((float)$persona['total_cancelar'], 2, ',', '.');
						$html.="</td>";

				$html.="</tr>";

				$html.="</table>";

    //echo $html;
	$mpdf=new mPDF();
	$mpdf->WriteHTML($html);
	$mpdf->Output();
exit;
?>
