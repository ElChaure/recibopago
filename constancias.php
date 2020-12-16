<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Sistema para Recibos de Pago</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/boot.css" />
        <script src="js/jquery.min.js" type="text/javascript"></script>

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
				$('#formCedula').submit(function(){
							  $('#usernameLoadingCuenta').show('slow');
						      $.post("verificarCed.php", {
						        cedula: $('#cedulaBuscar').val(),
						        cuenta: '2'
						      }, function(response){
						      	if(response==1){
						      		$('#existe').hide('slow');
						      		$('#noexiste').show('slow');
									return false;

						      	}else{
						      		var respuesta = jQuery.parseJSON(response);
						      		var datos = '';
									$.each(respuesta, function(arrayID,group) {
										$('#nombres_apellidos').empty();
									   	$('#nombres_apellidos').append(group.nombres_apellidos);
									   	$('#cedula').empty();
									   	$('#cedula').append(group.cedula);
									   	$('#descripcion').empty();
									   	$('#descripcion').append(group.descripcion);


									});
						      		$('#existe').show('slow');
						      		$('#noexiste').hide('slow');

							    }
						      });
						    	return false;


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
		<div class="wrapper">
			<h1 style="text-align:center;">Modulo de Validacion de Constancias de Trabajo</h1>

			<div class="content">
				<div id="form_wrapper" class="form_wrapper" style='width:512px !important'>

					<div class="container">
						<form class="login active" id='formCedula'>
							<h3>Introduzca los Siguientes Datos</h3>
							<div>
								<label>Cedula:</label>
								<input class="numeric" type="text" id="cedulaBuscar" required="" autofocus=""/>
								<span style="display: none;" id="usernameLoading"><img src="images/indicator.gif" alt="Ajax Indicator"></span>
								<span id="usernameResult"></span>
								
							</div>
							<br>

							<div id='existe' style='text-align: center !important; display:none;'>
								<table style='margin: 0 auto !important; text-align: left !important;' width='100%' class="table table-striped" cellpadding='20'>
									<tr>
										<td>Nombres y Apellidos: </td>
										<td id='nombres_apellidos'> </td>
									</tr>
									<tr>
										<td>Cedula: </td>
										<td id='cedula'> </td>
									</tr>
									<tr>
										<td>Cargo: </td>
										<td id='descripcion'> </td>
									</tr>

								</table>
								
							</div>
							<div id='noexiste' style='text-align: center !important; display:none;'>
								<table style='margin: 0 auto !important; text-align: left !important;' width='100%' class="table table-striped" cellpadding='20'>
									<tr>
										<td><STRONG>ES POSIBLE QUE ESTA PERSONA NO SIGA LABORANDO EN LA INSTITUCION</STRONG></td>
									</tr>

								</table>
								
							</div>
							<div class="bottom">
								<button class="btn btn-lg btn-primary btn-block" id='BuscarCedula' type="submit">Buscar</button>

								<div class="clear"></div>
							</div>
						</form>
							
					</div>
					
					
					
				</div>
				<div class="clear"></div>
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