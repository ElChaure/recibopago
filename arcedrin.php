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

 $query = ( "SELECT
t_d_pago_nomina.id_persona,
t_d_pago_nomina.total_asig,
t_d_pago_nomina.d_total,
t_d_pago_nomina.total_cancelar,
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
cedula='".$cedula."' and ano='2017'
ORDER BY id_quincena");
 $result=pg_query($query);
$rows=pg_num_rows($result); 
$dpersona=pg_fetch_all($result);
  if($dpersona==null){
    echo "<script>alert('Es posible que esta persona ya no labore en la institucion');window.close();</script>";

  }else{
    $persona=$dpersona[0];
    $cedula=number_format($persona['cedula'], 0, "", ".");
    $V=new EnLetras();
    $con_letra=strtoupper($V->ValorEnLetras($persona['total_asig'],"Bolivares")); 
    $monto=number_format($persona['total_asig'], 2, ",", ".");
    $total=0;
    
    
  



// Eu 1.234,56

   include('mpdf/mpdf.php');
      
    $html="<table align='center' style='border-collapse: collapse;' width='100%' >";
    $html.="<style>td{font-family:arial; font-size:11px;}  .titulos{font-size:12px;}</style>";
    $html.="<tr>";
        $html.="<td>";
            $html.="<img src='images/CINTILLO BARRIO AFUERA.png' width='750px' height='100x'>";
        $html.="</td>";
    $html.="</tr>";
    $html.="<tr>";
                $html.="<td align='center' width='227px'>";
            $html.="<strong>PLANILLA AR-C PERIODO 2017<BR></strong>NOMBRE Y APELLIDO: <strong>".$persona['nombres_apellidos'].' C.I.: '.$cedula."</strong><br>CARGO: ".$persona['descripcion']."";
        $html.="</td>";
    $html.="</tr>";
    $html.="</table>";
    
        //cuerpo
      
        $html.="<table align='center'>";
        $html.="<tr>";
         $html.="<td>";   
         
        $html.="<tr>";
         $html.="<td>";   
         $html.="<td><h4>Mes<td><h4>Asignaciones<td><h4>Deducciones<td><h4>&nbsp;&nbsp;&nbsp;Total&nbsp;Neto<td><h4>";
         $html.="</td>";       
        $html.="</tr>";        
                
          for($i=1;$i<=$rows; $i++){
          $line = pg_fetch_array($result, null, PGSQL_ASSOC);
          $html.="<tr>";
          $html.="<td>";    
          $html.="<td>".$line['mes']."<td>".(number_format($line['total_asig'],2,',','.'))."<td>".(number_format($line['d_total'],2,',','.'))."<td>".(number_format($line['total_cancelar'],2,',','.'))."";
          $html.="</td>";      
          $html.="</tr>";
          $total+=$line['total_cancelar'];

        }
        $html.="</table>";
        $html.="<tr>";
        $html.="<td width='566px'>";
            
        $html.="</td>";
        $html.="</tr>";
        $html.="----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";
        $html.="<table align='center'>";
        $html.="<tr>";
         $html.="<td>";
  $html.="TOTAL Bs:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
  
    $html.= number_format($total,2,',','.');
    $html.="</td>";      
        $html.="</tr>";
        $html.="</table>";


      $html.="<tr>";
          $html.="<td width='566px'>";
          $html.="<tr>";
          $html.="<td >";
             $html.="<table  align='center' width='100%'>
                     <tr>
                     <td colspan='3' align='center' style='vertical-align: bottom;'><img src='images/firmaEduardoPerez.PNG' width='150px'></img></td>
                     </tr>
                     <tr>
                     
                     <td class='notaFirma' align='center'><strong>Lcdo. Eduardo Pérez 
                                                                  Gerente de Gestión Administrativa</td>
                                                            
                                                        </tr>

                                                       </table>";
          $html.="</td>";
        $html.="</tr>";

        $html.="<tr>";
          $html.="<td width='566px'>";
                    $html.=" <table>
                          
                          <tr>
                            <td class='nota'>

                          </tr>
                         </table>";
                         $html.="<p align='center'>Planilla que se expide a solicitud de la parte interesada, el ".obtenerFechaEnLetra(date("Y-m-d")).".</p>";
          $html.="</td>";
        $html.="</tr>";


      $html.="</table>";
      //Se agrego el pie de pagina a solicitud del adjunto de talento humano en fecha 07-10-2015 por Cesar Franco
      $footer='<table width="100%">
                <tr>
                  <td align="center" style="font-family:arial; color:#959595; font-size:10px !important;">
                      <strong>Centro Simón Bolívar - Edif. Sur - Portal Municipal - Piso 3  Ofic. 325 - El Silencio Caracas  
                      - Telfs. (0212) 408.06.63 - Fax: (0212) 408.06.68 www.fmba.gob.ve
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
