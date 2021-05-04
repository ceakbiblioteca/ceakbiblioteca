<?php
/* Modifications
20210430 fho4abcd Removed duplicate header setting.Lineends
*/

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Manejar el diccionario de t�rminos de la base de datos
session_start();
if (!isset($_SESSION["permiso"])){
	header("Location: ../common/error_page.php") ;
}
include("../common/get_post.php");
//foreach ($arrHttp as $var => $value) 	echo "$var = $value<br>";
include("../config.php");

include ("../lang/admin.php");
include ("leerregistroisispft.php");

// Para presentar el diccionario de t�rminos

function PresentarDiccionario(){
global $arrHttp,$terBd,$xWxis,$db_path,$Wxis,$wxisUrl,$cisis_ver;

	if ($arrHttp["Opcion"]=="ir_a"){
		$arrHttp["LastKey"]=$arrHttp["prefijo"].$arrHttp["IrA"];
	}
	$arrHttp["Opcion"]="diccionario";
	$Prefijo=$arrHttp["prefijo"];
	if (isset($arrHttp["LastKey"]))
		$LastKey=$arrHttp["LastKey"];
	else
		$LastKey="";
	$IsisScript= $xWxis."ifp.xis";
	if (!isset($arrHttp["Formato"])) $arrHttp["Formato"]="";
	if (!isset($arrHttp["prologo"])) $arrHttp["prologo"]="";
	$query = "&base=".$arrHttp["base"]."&cipar=$db_path"."par/".$arrHttp["cipar"]."&Formato=".$arrHttp["Formato"]."&Opcion=".$arrHttp["Opcion"]."&prefijo=".$arrHttp["prefijo"]."&campo=".$arrHttp["campo"]."&Diccio=".$arrHttp["Diccio"]."&prologo=".$arrHttp["prologo"]."&LastKey=".$LastKey;
	$contenido=array();
	include("../common/wxis_llamar.php");
	$mayorclave="";
	foreach ($contenido as $linea){
		$pre=trim(substr($linea,0,strlen($arrHttp["prefijo"])));

		if ($pre==$arrHttp["prefijo"]){
			$l=explode('|',$linea);
			$ter=substr($l[0],strlen($arrHttp["prefijo"]));
            $ter=trim($ter);
            if (isset($arrHttp["id"]) and $arrHttp["id"]=="W"){
            	$l[0]=trim($l[0]);
            	if (strlen($l[0])==60)
            		$l[0].='$';
            }
            $ttll=trim($l[0]);
			echo "<option value=\"".$ttll."\">".$ter;
			if (isset($l[1])) echo " (".trim($l[1]).")";
			echo "\n";
			$mayorclave=$l[0];
		}
	}

	$arrHttp["LastKey"]=$mayorclave;
	$arrHttp["Opcion"]="epilogo";

}
// ------------------------------------------------------
// INICIO DEL PROGRAMA
// ------------------------------------------------------

include("../common/header.php");

include("ifpro.php");

switch ($arrHttp["Opcion"]){
	case "diccionario":
		$arrHttp["IsisScript"]="ifp.xis";
		PresentarDiccionario();
		break;
	case "mas_terminos":
		$arrHttp["IsisScript"]="ifp.xis";
		PresentarDiccionario();
		break;
	case "ir_a":
		PresentarDiccionario();
		break;
}

include("ifepil.php");
?>
