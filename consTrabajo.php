<?php
$cedula = $_GET['cedula'];
/*$dbconn = pg_connect("host=10.29.6.32 dbname=talento_humano user=root password=123456")
        or die('Could not connect: ' . pg_last_error());*/


/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,2,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "Cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Millón ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " " . $Frc. "/100";
       //$s = $s . " " . $Frc . "/100";
    }
    $letrass=$Signo . $s . " ";
    return ($Signo . $s . " ");
   
}


/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "Cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "Mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("Diez Un", "Once", $Rtn );
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
    $Rtn=str_replace("Veinte Seis", "Veintiseís", $Rtn );
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "a" , $Rtn);
    return($Rtn);
}


/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "Cero";break;
         Case 1:  $t = "Un";break;
         Case 2:  $t = "Dos";break;
         Case 3:  $t = "Tres";break;
         Case 4:  $t = "Cuatro";break;
         Case 5:  $t = "Cinco";break;
         Case 6:  $t = "Seis";break;
         Case 7:  $t = "Siete";break;
         Case 8:  $t = "Ocho";break;
         Case 9:  $t = "Nueve";break;
         Case 10: $t = "Diez";break;
         Case 20: $t = "Veinte";break;
         Case 30: $t = "Treinta";break;
         Case 40: $t = "Cuarenta";break;
         Case 50: $t = "Cincuenta";break;
         Case 60: $t = "Sesenta";break;
         Case 70: $t = "Setenta";break;
         Case 80: $t = "Ochenta";break;
         Case 90: $t = "Noventa";break;
         Case 100: $t = "Cien";break;
         Case 200: $t = "Doscientos";break;
         Case 300: $t = "Trescientos";break;
         Case 400: $t = "Cuatrocientos";break;
         Case 500: $t = "Quinientos";break;
         Case 600: $t = "Seiscientos";break;
         Case 700: $t = "Setecientos";break;
         Case 800: $t = "Ochocientos";break;
         Case 900: $t = "Novecientos";break;
         Case 1000: $t = "Mil";break;
         Case 1000000: $t = "Millón";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " Mil";break;
       Case 2: $t = " Millones";break;
       Case 3: $t = " Billones";break;
    }
    return($Rtn . $t);
}

}


/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/

function obtenerFechaEnLetra($fecha){

    $dia= conocerDiaSemanaFecha($fecha);

    $num = date("j", strtotime($fecha));

    $anno = date("Y", strtotime($fecha));

    $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    $mes = $mes[(date('m', strtotime($fecha))*1)-1];

    return $num.' de '.$mes.' del '.$anno;

}

 
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/
/*CODIGO COMPLEMENTARIO*/

function conocerDiaSemanaFecha($fecha) {

    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

    $dia = $dias[date('w', strtotime($fecha))];

    return $dia;

}

/*PROGRAMA PRINCIPAL*/
          /*
	$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
        */
        include("conexion.php");

  //perform query
  //MODIFICACION DEL QUERY PARA QUE TRAIGA EL ULTIMO SUELDO INTEGRAL SOLICITADO: ROBERT ZAMBRANO REALIZADO: CESAR FRANCO 07-10-2015
  $datosPersona = pg_query($dbconn, "SELECT
                    t_d_personal.nombres_apellidos,
                    t_n_nacionalidad.inicial,
                    t_d_personal.cedula,
                    t_d_personal.fecha_ingreso,
                    t_d_cargo.descripcion,
                    t_d_pago_nomina.sueldo_integral
                    FROM
                    t_d_personal
                    INNER JOIN  t_n_nacionalidad ON  t_d_personal.id_nacionalidad =  t_n_nacionalidad.id_nacionalidad
                    INNER JOIN  t_d_cargo ON  t_d_personal.cargo =  t_d_cargo.id_cargo
                    INNER JOIN  t_d_pago_nomina ON  t_d_pago_nomina.id_persona =  t_d_personal.id_personal
                    WHERE
                    cedula='".$cedula."' AND
                    id_estado_persona='1'
                    ORDER BY sueldo_integral desc  
                    LIMIT 1");
  $dpersona=pg_fetch_all($datosPersona);
  if($dpersona==null){
    echo "<script>alert('Es posible que esta persona ya no labore en la institucion');window.close();</script>";

  }else{
    $persona=$dpersona[0];
    $cedula=number_format($persona['cedula'], 0, "", ".");
    $V=new EnLetras();
    $con_letra=strtoupper($V->ValorEnLetras($persona['sueldo_integral'],"Bolivares")); 
    $monto=number_format($persona['sueldo_integral'], 2, ",", ".");

// Eu 1.234,56

    include('mpdf/mpdf.php');
      
      $html="<table align='center'  style='border-collapse: collapse;' width='100%' cellpadding='20'>";
        $html.="<style>td{font-family:arial; font-size:16px;} td {text-align: justify; line-height: normal;}.nota{font-size:9px;}.notaFirma{font-size:12px;}</style>";
        $html.="<tr>";
          $html.="<td width='566px'>";
            $html.="<img src='images/CINTILLO BARRIO AFUERA.png' width='750px' height='100x'>";
          $html.="</td>";
        $html.="</tr>";

        $html.="<tr>";
          $html.="<td width='566px'>";
            $html.="
              <table width='100%'>
                <tr>
                  <td align='center'><h3>CONSTANCIA DE TRABAJO</h3></td>
                </tr>
                <tr>
                  <td><p>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quien suscribe, Gerente de Gestión de Talento Humano de la Fundación Misión Barrio Adentro 
                  (FMBA), RIF:G-20006816-7; por medio de la presente se hace constar que el (la) ciudadano (a): <strong>".$persona['nombres_apellidos']."</STRONG>, titular de la cédula de identidad N° <strong>".$persona['inicial']." - ".$cedula."</strong>, presta 
                  sus servicios en esta institución desde el ".obtenerFechaEnLetra($persona['fecha_ingreso'])."; en calidad de <strong>".$persona['descripcion']."</strong>
                  , percibiendo para los corrientes una remuneración mensual de <strong>".$con_letra." (Bs. ".$monto."</strong>). Así mismo, percibe el Beneficio Bono 
                  de Alimentación correspondiente a 61 Unidades Tributarias por un Monto de <strong>DOS MILLONES CIENTO NOVENTA Y SEIS MIL BOLIVARES CON CERO CENTIMOS (Bs.2.196.000,00)  MENSUALES.</strong>.</p></td>
                </tr>
              </table>";
              
          $html.="</td>";   
        $html.="</tr>";

        $html.="<tr>";
          $html.="<td width='566px'>";
            $html.="<p>Constancia que se expide a solicitud de la parte interesada, el ".obtenerFechaEnLetra(date("Y-m-d")).".</p>";
          $html.="</td>";
        $html.="</tr>";


        $html.="<tr>";
          $html.="<td >";
                        $html.="<table  align='center' width='100%'>
                                                        <tr>
                                                            <td colspan='3' align='center' style='vertical-align: bottom;'><img src='images/firmajulio.PNG' width='210px'></img></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td class='notaFirma' align='center'><strong>Julio Cesar Sandoval Escalona</strong><br>Gerente de Gestión de Talento Humano<br>Fundación Misión Barrio Adentro<br>Según Providencia Administrativa N°38 de fecha 25-07-2017</td>
                                                            <td></td>
                                                        </tr>

                                                    </table>";
          $html.="</td>";
        $html.="</tr>";

        $html.="<tr>";
          $html.="<td width='566px'>";
                    $html.=" <table>
                          <tr>
                            <td align='center' class='nota'><strong>Requiere sello húmedo.</strong> Va sin enmienda. Valida por tres (3) meses a partir de su fecha de expedición.</td>
                          </tr>
                          <tr>
                            <td class='nota'><p> Nota: Esta constancia ha sido impresa electrónicamente a través del siguiente enlace www.fmba.gob.ve, que conecta con la Intranet y el Módulo de Constancia de Trabajo.
                            La información reflejada en ella esta sujeta a validación por parte de la Gerencia de Talento Humano, como entidad generadora y contralora de la misma.</p> 
                            
                          </tr>
                         </table>";
          $html.="</td>";
        $html.="</tr>";


      $html.="</table>";
      //Se agrego el pie de pagina a solicitud del adjunto de talento humano en fecha 07-10-2015 por Cesar Franco
      $footer='<table width="100%">
                <tr>
                  <td align="center" style="font-family:arial; font-size:10px !important;">
                      <strong>"Pueblo Victorioso. No Podemos optar entre vencer o morir. Necesario es vencer"</strong><br>
                      Centro Simón Bolívar, Edificio Sur, Piso 3. Oficina 325, El Silencio. Telefono: 0212-408.0663 Ext. 20684(Central)<br>
                      www.fmba.gob.ve
                  </td>
                </tr>
              </table>';
        //echo $html;exit;
      $mpdf=new mPDF();
      $mpdf->SetWatermarkImage('images/badentro.jpg',0.1,'', array(0,60));
      $mpdf->showWatermarkImage = true;
      $mpdf->WriteHTML($html);
      $mpdf->SetHTMLFooter($footer);
      $mpdf->Output();
    exit;
  }
?>
