

<html>
 <head>
    <title>Intranet</title>
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    
    <meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="aspecto-validar.css">
		<img id='logo' src='logo2.png'>
    <legend class="centrado" align="center"><h1>Intranet</h1></legend>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
        
    <script type="text/javascript" src="calendario/tcal.js"></script> 
    <script>
  function numerocedula(e)//validacion numerica de la cedula
  {
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    cedula="0123456789";
    especiales="8-37-38-46";//arreglo d teclas especiales
    teclado_especial=false;
    for(var i in especiales)
    {
      if(key==especiales[i])
      {
        teclado_especial=true;
      }
    if(cedula.indexOf(teclado)==-1 && !teclado_especial)
    {
      return false;
    }

    }

  }
</script>
 
   </head>
      
<body>

    <form method="POST"  name="maylet" action=validar-perfil.php>
	  <div>
        <fieldset> 
        
          <table class="tabla" border="0" >
       		      
       
		    <td ><h4>Número de Doc. de Identidad</h4>
			   <input size="40%" onpaste="return false" name ='cedula' type="text" id="cedula" placeholder="1234567(sin punto) "onkeypress="return numerocedula(event)" value="<?php echo @$_POST['cedula']?>" required/>    
         
     
 </table>
            
              <input type="submit" value="Siguiente" name="reg" >
               
   </fieldset>
       
  </form>
  
   <form>
   <p>Esta información es considerada confidencial y de uso extrictamente laboral para la Fundación Barrio Adentro</p> 
   </form>
   </body>

</html>
   