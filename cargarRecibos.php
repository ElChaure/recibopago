<script>
		$(document).ready(function(){
				$('select').material_select();
			    $('.collapsible').collapsible({
			      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
			    });
				$('#salirSistema').click(function(){
					location.reload();

			    //Por hay va la vaina
				});
				$('#salirSis').click(function(){
         			window.location.href = "http://www.google.com/";    
				}); 
				//.............
		      $.post("verificarCed.php", {
			        cedula: $('#cedulaBuscar').val(),
			        cuenta: '1'
			      }, function(response){
				      		var respuesta = jQuery.parseJSON(response);
				      		var datos = '';
							$.each(respuesta, function(arrayID,group) {
							    datos+='<b>Cedula:</b> '+group.cedula+'<br><b>Nombre y Apellido:</b> '+group.nombres_apellidos+'<br><b>Cargo:</b> '+group.cargo+'<br><b>Nomina:</b> '+group.nomina;

							});
							$('#datosP').append(datos);


			      });

				$('#database').change(function(){
			      $.post("consultasRecibo.php", {
				        cedula: $('#cedulaBuscar').val(),
				        cuenta: $('#cuentaBuscar').val(),
				        ano: $('#database').val(),
				      }, function(response){
				      		if(response!=1){
					      		var respuesta = jQuery.parseJSON(response);
					      		var tabla='';
					      		$('#bodyTable').empty();
								$.each(respuesta, function(arrayID,group) {
								            tabla+="<tr>";
								            	tabla+="<td>";
								            		tabla+=group.descripcion;
								            	tabla+="</td>";
								            	tabla+="<td>";
								            		tabla+=group.fecha_inicio+' - '+group.fecha_fin;
								            	tabla+="</td>";
								            	tabla+="<td>";
								            		tabla+=formatNumber(group.total_asig);
								            	tabla+="</td>";
								            	tabla+="<td>";
								            		tabla+=formatNumber(group.d_total);
								            	tabla+="</td>";
								            	tabla+="<td>";
								            		tabla+=formatNumber(group.total_cancelar);
								            	tabla+="</td>";
								            	tabla+="<td>";
								            		tabla+='<a type="button" href="reciboPago.php?id_nomina='+group.id_pago_nomina+'" target="_blank" class="btn waves-effect waves-light">Descargar</a>'

								            		//tabla+='<button type="button" formtarget="_blank" id="'+group.id_pago_nomina+'"class="btn btn-primary">Descargar</button>'
								            	tabla+="</td>";
								            	
								            tabla+="</tr>";

								});
								$('#bodyTable').append(tabla);
								$('#tablaNomina').show('slow');
							}else{

								var resp="<tr><td align='center' colspan='6'>NO EXISTEN REGISTROS</td></tr>"
								$('#bodyTable').empty();
								$('#bodyTable').append(resp);
							}


				      });
			    });
		});


		function formatNumber(number)
		{

			number=parseFloat(number);
		    number = number.toFixed(2) + '';
		    var x = number.split('.');
		    var x1 = x[0];
		    var x2 = x.length > 1 ? '.' + x[1] : '';
		    var rgx = /(\d+)(\d{3})/;
		    while (rgx.test(x1)) {
		        x1 = x1.replace(rgx, '$1' + ',' + '$2');
		    }
		    return x1 + x2;
		}


</script>

		

						<h3 align='center'>Fundación Misión Barrio Adentro</h3>
						  <ul class="collapsible popout" data-collapsible="accordion">
						    <li>
						      <div class="collapsible-header"><i class="material-icons">filter_drama</i>Datos Personales</div>
						      <div class="collapsible-body"><p id='datosP'></p></div>
						    </li>
							 <!--<li>
						      <div class="collapsible-header"><i class="material-icons">settings_applications</i>SISAP</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>SISAP</STRONG></H4>
						        <a type="button" href='http://sisap.fmba.gob.ve/infogobierno?cedula=<?php echo $_POST['cedula']; ?>' target="_blank" class="btn waves-effect waves-light">INGRESAR</a>
						    
						      </div>
						    </li>-->						   
						    <li>
						      <div class="collapsible-header"><i class="material-icons">place</i>Constancia de Trabajo</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>CONSTANCIA DE TRABAJO</STRONG></H4><BR>
						      	<a type="button" href='consTrabajo.php?cedula=<?php  echo $_POST['cedula']; ?>' target="_blank" class="btn waves-effect waves-light">DESCARGAR</a>
						      </div>
						    </li>
						    <li>
						      <div class="collapsible-header"><i class="material-icons">view_headline</i>Planilla AR-C</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>PLANILLA AR-C</STRONG></H4>
						        <a type="button" href='arcedrin.php?cedula=<?php echo $_POST['cedula']; ?>' target="_blank" class="btn waves-effect waves-light">CONSULTAR</a>
						    
						      </div>
						    </li>

							  <li>
						      <div class="collapsible-header"><i class="material-icons">whatshot</i>Recibos de Pago</div>
						      <div class="collapsible-body">
											<div class="form-group" style="width:100% !important">

													<label>
														Seleccione el año que desea consultar:
														<select id="database" name="database">
															<option value="0">Seleccione...</option>
															<option value="2015">2015</option>
															<option value="2016">2016</option>
															<option value="2017">2017</option>
															<option value="2018">2018</option>
															
														</select>
													</label>


												<div id='tablaNomina' style='display:none; width:100%;'>
													<label>
														<table class="table table-striped" style="width:100% !important;">
													  		<thead>
															  <tr>
															  	<th>Nómina</th>
															  	<th>Período</th>
															  	<th>Asignaciones</th>
															  	<th>Deducciones</th>
															  	<th>Neto a Cobrar</th>
															  	<th>Descargar</th>
															  </tr>
															</thead>
															<tbody id='bodyTable'>

															</tbody>

														</table>
													</label>

												</div>

											</div>
						      </div>
						    </li>
						    <!--<li>
						   		<div class="collapsible-header"><i class="material-icons">file_download</i>Descarga de Documentos</div>
						      <div class="collapsible-body" style="text-align:center;">
						           <h4><STRONG>(Instructivos, Manuales, Normativas.)</STRONG></h4><br/>
						        <a type="button" href='descargas.php' target="_blank" class="btn waves-effect waves-light">DESCARGAR</a>
						    
						      </div>
						   </li>
						   <li>
						      <div class="collapsible-header"><i class="material-icons">lock</i>SIGESP</div>
						      <div class="collapsible-body">
											<div class="form-group" style="width:100% !important">

													<label>
														Seleccione el SIGESP que desea consultar:
														<select id="sigesp" name="sigesp">
															<option value="">Seleccione... </option>
															<option value="http://enterprise2017.fmba.gob.ve/">SIGESP 2017</option>
														    <option value="http://enterprise.fmba.gob.ve/sigesp_2016/inicio.html">SIGESP 2016</option>
														    <option value="http://sigespv2.fmba.gob.ve/">SIGESP 2015</option>
														    <option value="http://sigesp.fmba.gob.ve/">SIGESP HISTORICO</option>
														</select>
							<script>
    						document.getElementById("sigesp").onchange = function() {
        					if (this.selectedIndex!==0) {
            				window.location.href = this.value;
        					}        
    						};
							</script>


													</label>
							</li>
							
							<li>
						      <div class="collapsible-header"><i class="material-icons">email</i>Correo</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>Correo Institucional</STRONG></H4>
						        <a type="button" href='http://correo.fmba.gob.ve' target="_blank" class="btn waves-effect waves-light">LOGEAR</a>
						    
						      </div>
						    </li>

						    <li>
						      <div class="collapsible-header"><i class="material-icons">report_problem</i>SAT</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>Sistema de Asistencia Técnica</STRONG></H4>
						        <a type="button" href='http://www.fmba.gob.ve/html/soporte/upload/' target="_blank" class="btn waves-effect waves-light">LOGEAR</a>
						    
						      </div>
						    </li>
							
							 <li>
						      <div class="collapsible-header"><i class="material-icons">settings_applications</i>Sistema de Gestión Integrado</div>
						      <div class="collapsible-body" style="text-align:center;">
						      	<H4><STRONG>Sistema de Gestión Integrado</STRONG></H4>
						        <a type="button" href='http://www.fmba.gob.ve/html/crud2p/' target="_blank" class="btn waves-effect waves-light">LOGEAR</a>
						    
						      </div>
						    </li>

							</ul>-->
						<div class="bottom">
							<button class="btn btn-lg btn-primary btn-block" id='salirSistema' type="button" href='http://www.fmba.gob.ve'>SALIR</button>

							<div class="clear"></div>
						</div>
						

