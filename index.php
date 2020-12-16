<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>INTRANET</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/boot.css" />
        <script src="js/jquery.min.js" type="text/javascript"></script>

      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>

      <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

		
		<script src="js/cufon-yui.js" type="text/javascript"></script>
		<script src="js/ChunkFive_400.font.js" type="text/javascript"></script>
		<script src="js/jquery.numeric.js" type="text/javascript"></script>
		<script src="js/jquery.numeric.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
			Cufon.replace('h3',{ textShadow: '1px 1px #000'});
			Cufon.replace('.back');

			
			
			$(document).ready(function(){

  			
          
				  $('.datepicker').pickadate({
						monthsFull: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
						weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vie', 'Sab'],
						today: 'Hoy',
						clear: 'Limpiar',
						close: 'Aceptar',

						format: 'yyyy-mm-dd',
						selectMonths: true, // Creates a dropdown to control month
						selectYears: 20, // Creates a dropdown of 15 years to control year
					  });

				$('#cedulaBuscar').val('');
				$('#cuentaBuscar').val('');
				$('#formCedula').submit(function(){
							  $('#usernameLoadingCuenta').show('slow');
							  var cedula=$('#cedulaBuscar').val();
							  var cuenta=$('#cuentaBuscar').val();
							  if((cedula=='')||(cuenta=='')){
							  	$( "#textH" ).text("Todos los Campos deben ser Completados");
							  	$('#modal1').openModal();
							  	$('#usernameLoadingCuenta').hide('slow');
							  	return false;
							  }
						      $.post("verificarCed.php", {
						        cedula: $('#cedulaBuscar').val(),
						        cuenta: $('#cuentaBuscar').val()
						      }, function(response){

						      	if(response==1){
						      		$('#usernameLoadingCuenta').hide('slow');
						      		$('#usernameResultCuenta').fadeOut();
									$('#formCedula').hide('slow');
									$('#pruebaCarga').show('slow');
									$('#pruebaCarga').load('cargarRecibos.php',{
													           cedula: $('#cedulaBuscar').val(), 
													           cuenta: $('#cuentaBuscar').val()
													       	});
									$('.form_wrapper').css('width','100%');
									$('.form_wrapper .column').css('width','119%');
									return false;

						      	}else{
						      		$('#usernameLoadingCuenta').hide('slow');
							        $('#usernameResultCuenta').fadeOut('slow');
							        setTimeout("finishAjax('usernameResultCuenta', '"+escape(response)+"')", 400);
							    }
						      });
						    	return false;


				});


				var timer;
				$("#cedulaBuscar").keyup(function(){
				//$(".numeric").numeric();
					    clearInterval(timer);  //clear any interval on key up
					    timer = setTimeout(function() { //then give it a second to see if the user is finished
							  $('#usernameLoading').show('slow');
						      $.post("verificarCed.php", {
						        cedula: $('#cedulaBuscar').val(),
						        cuenta: $('#cuentaBuscar').val()
						      }, function(response){
						      	if(response==1){
						      		$('#usernameLoading').hide('slow');
						      		$('#usernameResult').fadeOut();
						      		$('#digitosC').show('slow');


						      	}else{
						      		$('#digitosC').hide('slow');
							        $('#usernameResult').fadeOut('slow');
							        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 400);
							    }
						      });
						    	return false;
					    }, 1000);

				});
			});
			function finishAjax(id, response) {
			  $('#usernameLoading').hide('slow');
			  $('#'+id).html(unescape(response));
			  $('#'+id).fadeIn('slow');
			} //finishAjax
		</script>
    </head>
    <body>
    <div class="w3-display-container">
      <img src="images/cintillozamora.png" alt="Lights" class="w3-image" style="width:100%">
    </div>
		<div class="wrapper">
			<!--h1 style="text-align:center;">Talento Humano</h1-->
<center>
                        <img src="images/Tit_Prueba.jpg" alt="Lights" class="w3-image" style="width:50%">
</center>
			<div class="content hoverable">
				<div id="form_wrapper" class="form_wrapper">

					<div class="container">
						<form class="login active" id='formCedula'>
							<h3 style="text-align:center;">Acceso a Consultas</h3>
							<div class="input-field col s6">
								
								<input class="validate" type="text" id="cedulaBuscar" required="" placeholder="C.I." />
								<label for="cedulaBuscar">Cedula:</label>
								<span style="display: none;" id="usernameLoading"><img src="images/indicator.gif" alt="Ajax Indicator"></span>
								<span id="usernameResult"></span>
								
							</div>
							<div class="section scrollspy" id='digitosC' style='display:none;'>
								<label for="cuentaBuscar">Fecha de Ingreso Laboral: </label>

  								<input id="cuentaBuscar" type="date" class="datepicker" placeholder='Año-Mes-Dia' required="">
								<span style="display: none;" id="usernameLoadingCuenta"><img src="images/indicator.gif" alt="Ajax Indicator"></span>
								<span id="usernameResultCuenta"></span>
								

								
							</div>

							<h3 style="text-align: center; border-bottom-style: none !important; background-color: #ffffff !important;">


								<button id='BuscarCedula' class="btn waves-effect waves-light" type="submit">Ingresar</button>

							</h3>

							</form>

						<form id='pruebaCarga' class="prueba">

						</form>
						
						<!-- Aqui Empezamos el Recibo -->
						
							
					</div>
					
					
					
				</div>
				<div class="clear"></div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<!-- 
			<div clas="retorno">
				<td><a href="http://"><img src="images/boton5.png" width="200" aling="right" height="90"</a></td>
			</div>
			-->

		  <div id="modal1" class="modal bottom-sheet">
		    <div class="modal-content" style="text-align:center;">
		      <h2 id='textH'></h2>
		    </div>
		  </div>


		</div>
		

		<!-- The JavaScript -->

		<script type="text/javascript">
			$(function() {
					//the form wrapper (includes all forms)
				var $form_wrapper	= $('#form_wrapper'),
					//the current form is the one with class active
					$currentForm	= $form_wrapper.children('form.active'),
					//the change form links
					$linkform		= $form_wrapper.find('.linkform');
						
				//get width and height of each form and store them for later						
				$form_wrapper.children('form').each(function(i){
					var $theForm	= $(this);
					//solve the inline display none problem when using fadeIn fadeOut
					if(!$theForm.hasClass('active'))
						$theForm.hide();
					$theForm.data({
						width	: $theForm.width(),
						height	: $theForm.height()
					});
				});
				
				//set width and height of wrapper (same of current form)
				setWrapperWidth();
				
				/*
				clicking a link (change form event) in the form
				makes the current form hide.
				The wrapper animates its width and height to the 
				width and height of the new current form.
				After the animation, the new form is shown
				*/
				$linkform.bind('click',function(e){
					var $link	= $(this);
					var target	= $link.attr('rel');
					$currentForm.fadeOut(400,function(){
						//remove class active from current form
						$currentForm.removeClass('active');
						//new current form
						$currentForm= $form_wrapper.children('form.'+target);
						//animate the wrapper
						$form_wrapper.stop()
									 .animate({
										width	: $currentForm.data('width') + 'px',
										height	: $currentForm.data('height') + 'px'
									 },500,function(){
										//new form gets class active
										$currentForm.addClass('active');
										//show the new form
										$currentForm.fadeIn(400);
									 });
					});
					e.preventDefault();
				});
				
				function setWrapperWidth(){
					$form_wrapper.css({
						width	: $currentForm.data('width') + 'px',
						height	: $currentForm.data('height') + 'px'
					});
				}
				
				/*
				for the demo we disabled the submit buttons
				if you submit the form, you need to check the 
				which form was submited, and give the class active 
				to the form you want to show
				*/
				$form_wrapper.find('input[type="submit"]')
							 .click(function(e){
								e.preventDefault();
							 });	
			});
        </script>
    </body>
</html>
