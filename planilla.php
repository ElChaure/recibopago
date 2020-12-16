
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" >

 <head>
    <title>Perfil del Personal</title>
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
    
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="aspecto-ficha.css">
    <img id='logo' src='logo2.png'>
    <legend class="centrado" align="center"><h1>PERFIL DEL PERSONAL</h1></legend>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <!-- link calendar resources -->
    <link rel="stylesheet" type="text/css" href="calendario/tcal.css" />
    <script type="text/javascript" src="calendario/tcal.js"></script> 
  
   <script>
  function sololetras(e)//validacion solo letras
  {
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();//MINUSCULAS
    letras=" abcdefghijklmnñopqrstuvwxyzóúíáé´ÑÁÉÍÓüÜÚ";//solo letras y espacio
    especiales="8-9-37-38-39-46-164-127";//arreglo d teclas especiales aceptadas
    teclado_especial=false;
    for(var i in especiales)
    {
      if(key==especiales[i])
      {
        teclado_especial=true;break;
      }
    if(letras.indexOf(teclado)==-1 && !teclado_especial)
    {
      return false;
    }

    }

  }
</script>
    <script>
  function numerocedula(e)//validacion numerica de la cedula
  {
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    cedula="0123456789";
    especiales="8-9-37-38-46-127";//arreglo d teclas especiales
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
 <script>
  function numerotelefono(e)//validacion numerica de la telefono
  {
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);
    telefono="0123456789";
    especiales="8-37-38-46";//arreglo d teclas especiales
    teclado_especial=false;
    for(var i in especiales)
    {
      if(key==especiales[i])
      {
        teclado_especial=true;
      }
    if(telefono.indexOf(teclado)==-1 && !teclado_especial)
    {
      return false;
    }

    }

  }
</script>
   </head>
      
<body>

    <form method="POST"  name="maylet" action="ingreso-personal-perfil.php">
    <div>
        <fieldset> 
          <table class="tabla" border="0" >
          <td><h3><u>Datos Personales</u></h3>
       </tr>
        <td width="180"><h4>Doc. de Identidad</h4>
         <input onpaste="return false" name ='cedula' type="text" id="cedula"readonly placeholder="1234567(sin punto) "onkeypress="return numerocedula(event)" value="<?php echo @$_POST['cedula']?>" required/>    
        
        <td width="180"><h4>Nacionalidad</h4>
          <select  type="text" name="nac" id="nac" style="width:120" required/ >
                  <option value="" disabled selected>Seleccione</option>
                  <option value='V'>Venezolano(a)</option>
                  <option value='E'>Extranjero(a)</option>
                  <option value='P'>Pasaporte</option>
                  <option value='T'>Trámite</option>
           </select>
          <td width="180"><h4>Nombres</h4>
        <input onkeypress="return sololetras(event)" type="text" name="nombres" placeholder="ejem. ANA MARIA"style="width:180" value="<?php echo @$_POST['nombres']?>" required/>
       
       <td width="180"><h4>Apellidos</h4>
         <input onkeypress="return sololetras(event)"  type="text" name="apellidos" placeholder="ejem. PEREZ LEAL" style="width:180" value="<?php echo @$_POST['apellidos']?>" required/>
      
            <td width="180"><h4>Sexo</h4>
           <input type="radio" name="sexo" value="F" required/>Femenino
           <input type="radio" name="sexo" value="M" required/>Masculino
      
      </tr> 
        
    <td width="180"><h4>Fecha/Nacimiento</h4>
    
    <input type="text" name="fechaNac"  placeholder='Dia/Mes/año' readonly class="tcal" value="<?php echo @$_POST['fechaNac']?>" required/>
    
   
         <td width="180"><h4>Lugar/Nacimiento</h4>
        <input onkeypress="return sololetras(event)" type="text" name="lugarNac" placeholder="ejem. LOS SAMANES" style="width:180" value="<?php echo @$_POST['lugarNac'] ?>" required/>
    
      <td width="50" ><h4>Estado/Nacimiento</h4>
                         <select name="edoNac" style="width:150"/ >
                             <option value="" disabled selected>Seleccione un Estado</option>
                             <option value="1">AMAZONAS</option>
                             <option value="2">ANZOATEGUI</option>
                             <option value="3">APURE</option>
                             <option value="4">ARAGUA</option>
                             <option value="5">BARINAS</option>
                             <option value="6">BOLIVAR</option>
                             <option value="7">CARABOBO</option>
                             <option value="8">COJEDES</option>
                             <option value="9">DELTA AMACURO</option>
                             <option value="10">DISTRITO CAPITAL</option>
                             <option value="11">FALCON</option>
                             <option value="12">GUARICO</option>
                             <option value="13">LARA</option>
                             <option value="14">MERIDA</option>
                             <option value="15">MIRANDA</option>
                             <option value="16">MONAGAS</option>
                             <option value="17">NUEVA ESPARTA</option>
                             <option value="18">PORTUGUESA</option>
                             <option value="19">SUCRE</option>
                             <option value="20">TACHIRA</option>
                             <option value="21">TRUJILLO</option>
                             <option value="22">VARGAS</option>
                             <option value="23">YARACUY</option>
                             <option value="24">ZULIA</option>
                         </select>     
                 
      <td width="180"><h4>Municipio/Nacimiento</h4>
        <input onkeypress="return sololetras(event)" type="text" name="muniNac" placeholder="ejem. LOS SAMANES" style="width:180" value="<?php echo @$_POST['muniNac']?>" />
        
     <td width="180"><h4>Parroquia/Nacimiento</h4>
      <input type="text" name="parroNac" placeholder="ejem. LOS SAMANES" style="width:180" value="<?php echo @$_POST['parroNac']?>" />
        
        
   </tr>  

      <td width="180"><h4>Estado Civil</h4>
          <select name="civil" style="width:180" required/>
                  <option value="" disabled selected>Seleccione</option>
                  <option value="S">Soltero(a)</option>
                  <option value="C">Casado(a)</option>
          <option value="D">Divorciado(a)</option>
           <option value="V">Viudo(a)</option>
                  <option value="C">Concubinato</option>
                  
                </select>
          <td width="200"><h4>Número de Hijos</h4>
         <input type="tel" name="hijos" id="hijos" placeholder="ejem:10 "onkeypress="return numerotelefono(event)" value="<?php echo @$_POST['hijos']?>" required/>
            
                 <td width="200"><h4>Tipo de Vivienda</h4>
                     <select name="vivienda" style="width:150" required/>
                          <option value="" disabled selected>Seleccione</option>
                          <option value="P">Propia</option>
                          <option value="A">Alquilada</option>
                          <option value="NT">No Tiene</option>
                          <option value="DF">De un Familiar</option>
                      </select>
             <td width="180"><h4>Teléfono</h4>
                   <input type="tel" name="telefono" id="telefono" placeholder="0416900123(sin guión)" onkeypress="return numerotelefono(event)" value="<?php echo @$_POST['telefono']?>" required/>   
               <td width="180"><h4>Correo Electrónico</h4>
            <input type="email" name="email" placeholder="ejem. correo@g.com"style="width:180" value="<?php echo @$_POST['email']?>" />
             <tr>   

            <td width="580" colspan="3" ><h4>Dirección donde Vive</h4> 
             <input size="98%" type="text" name="direccion"  placeholder="ejem.Casa/Apto. Sector,Parroquia,Municipio y Estado" required value="<?php echo @$_POST['direcion']?>"/>
             <tr>
              <td><h3><u>Datos Laborales</u></h3>  
          </tr>   
         <td width="300"><h4>Nivel Académico:</h4>
                      <select name="academico" style="width:120" required/>
                              <option value="" disabled selected>Seleccione</option>
                              <option value="1">Primaria</option>
                              <option value="2">Básica</option>
                              <option value="3">Bachiller</option>
                              <option value="4">Técnico Medio</option>
                              <option value="5">Técnico Superior</option>
                              <option value="6">Universitaria</option>
                              <option value="7">Especialización</option>
                              <option value="8">Maestría</option>
                              <option value="9">Doctorado</option>
                          </select>
                    <td width="300"><h4>Profesión:</h4>
          <input onkeypress="return sololetras(event)" type="text" name="profesion" placeholder="ejem. INGENIERO" style="width:180" value="<?php echo @$_POST['profesion']?>" required/> 
                   
                  <td width="300" higth="50"><h4>Ingreso a FMBA</h4>
                  <input type="text" name="fechaFMBA"  placeholder='Dia/Mes/Año' readonly class="tcal" value="<?php echo @$_POST['fechaFMBA']?>"  required/>

                   <td name="cargo" width="300" required/><h4>Cargo Actual:</h4>
                    <input onkeypress="return sololetras(event)" type="text" name="cargo" placeholder="ejem. ANALISTA" style="width:180" value="<?php echo @$_POST['cargo']?>" required/>   
                     <td width="300" ><h4>Ingreso A.Pública</h4>
                
                <input type="text" name="fechaAP"  placeholder='Dia/Mes/Año' readonly class="tcal" value="<?php echo @$_POST['fechaAP']?>" />

               </tr> 
                <td width="300"><h4>Nombre de Centro</h4>
                    <input type="text" name="ncentro"  style="width:200" placeholder="ejem. AGUACATICO"required/>
                  
                    <td width="50" ><h4>Estado/Centro</h4>
                         <select name="edocentro" style="width:150" required/>
                             <option value="" disabled selected>Seleccione un Estado</option>
                             <option value="1">AMAZONAS</option>
                             <option value="2">ANZOATEGUI</option>
                             <option value="3">APURE</option>
                             <option value="4">ARAGUA</option>
                             <option value="5">BARINAS</option>
                             <option value="6">BOLIVAR</option>
                             <option value="7">CARABOBO</option>
                             <option value="8">COJEDES</option>
                             <option value="9">DELTA AMACURO</option>
                             <option value="10">DISTRITO CAPITAL</option>
                             <option value="11">FALCON</option>
                             <option value="12">GUARICO</option>
                             <option value="13">LARA</option>
                             <option value="14">MERIDA</option>
                             <option value="15">MIRANDA</option>
                             <option value="16">MONAGAS</option>
                             <option value="17">NUEVA ESPARTA</option>
                             <option value="18">PORTUGUESA</option>
                             <option value="19">SUCRE</option>
                             <option value="20">TACHIRA</option>
                             <option value="21">TRUJILLO</option>
                             <option value="22">VARGAS</option>
                             <option value="23">YARACUY</option>
                             <option value="24">ZULIA</option>
                         </select>     
                 
                  <td width="300"><h4>Municipio/Centro:</h4>
                        <input onkeypress="return sololetras(event)" type="text" name="municentro"  style="width:180" placeholder="ejem. LIBERTADOR" required/>   
                        <td width="300"><h4>Parroquia/Centro:</h4>
                    <input onkeypress="return sololetras(event)" type="text" name="parrocentro"  style="width:180" placeholder="ejem. ANTIMANO" required/>
                            
  
 </table>
            
              <input type="submit" value="Registrar" name="reg" >
              
   </fieldset>
       
  </form>
  
   <form>
   <p>Ingrese TODA la información Solicitada, ya que pasará a formar parte de su expediente laboral dentro de la Fundación Barrio Adentro</p> 
   <p>Omitir información o ingresar datos falsos podría ser motivo de sanciones. </p> 
   </form>
   </body>

</html>
   