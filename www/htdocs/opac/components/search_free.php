<?php
/*
20220307 rogercgui fixed index $prefijo=$x[1];

*/


if (!isset($titulo_pagina)){
	//if (isset($_REQUEST["indice_base"]) and $_REQUEST["indice_base"]=="") unset($_REQUEST["integrada"]);
	if (isset($_REQUEST["modo"])and  $_REQUEST["modo"]=="integrado"){
	?>	
		<h6><?php echo $msgstr["todos_c"];?></h6>
		<input type="hidden" name="modo" value="integrado">
	<?php
	}else{
		if (isset($_REQUEST["base"]) and $_REQUEST["base"]!=""){
			echo "<h6>".$bd_list[$_REQUEST["base"]]["titulo"];
			$yaidentificado="S";
			if (isset($_REQUEST["coleccion"]) and $_REQUEST["coleccion"]!="") {
				$_REQUEST["coleccion"]=urldecode($_REQUEST["coleccion"]);
				$cc=explode('|',$_REQUEST["coleccion"]);
				echo " > <i>".$cc[1]."</i>";
			}
		}
	}
	echo "</h6>";
}
if (!isset($mostrar_libre) or $mostrar_libre!="N"){
?>

	

<div id="search">

<div id="searchBox" class="p-4 mb-4 bg-light rounded-3">

<form method="get" action="buscar_integrada.php" name="libre">
		<?php
		if (isset($_REQUEST["db_path"])) echo "<input type=hidden name=db_path value=".$_REQUEST["db_path"].">\n";
		if (isset($lang)) echo "<input type=hidden name=lang value=".$lang.">\n";
		if (isset($_REQUEST["Formato"]))echo "<input type=hidden name=indice_base value=".$_REQUEST["Formato"].">\n";
		if (isset($_REQUEST["indice_base"]))echo "<input type=hidden name=indice_base value=".$_REQUEST["indice_base"].">\n";
		if (isset($_REQUEST["base"]))echo "<input type=hidden name=base value=".$_REQUEST["base"].">\n";
		if (isset($_REQUEST["modo"]))echo "<input type=hidden name=modo value=".$_REQUEST["modo"].">\n";
		?>

<div class="row g-3">
	<div class="col-md-6">
		<input class="form-control" type="text" name="Sub_Expresion" id="search-text" value="<?php if (isset($_REQUEST['Sub_Expresion'])) echo $_REQUEST['Sub_Expresion'];?>" placeholder="<?php echo $msgstr["search"]?>  ..."/>
	</div>


	<div class="col-md-3">
		<?php include 'components/dropdown_db.php'; ?>
	</div>

	
	<div class="col-md-3">
		<button type="submit"  class="btn btn-success mb-3 w-100"><i class="fa fa-search"></i> <?php echo $msgstr["search"]?></button>
	</div>
</div>

<!-- // Buttons -->

<div class="row g-3">

	<div class="col-auto">
		<label><?php echo $msgstr["resultados_inc"]?> </label>

		<div class="form-check">
			<input type="radio" value="and" name="alcance" id="and" class="form-check-input">
			<label class="form-check-label"><?php echo $msgstr["todas_p"]?> </label>
		</div>

		<div class="form-check">
			<input type="radio" value="or" name="alcance" id="or" checked class="form-check-input">
			<label class="form-check-label"><?php echo $msgstr["algunas_p"]?></label>
		</div>
	</div><!--/more-->
</div>

<div class="row g-3">
	<?php if (!isset($BusquedaAvanzada) or isset($BusquedaAvanzada) and $BusquedaAvanzada=="S"){ ?>

		<div class="col-auto">
				<button type="button" class="btn btn-light" onclick="javascript:document.libre.action='avanzada.php';document.libre.submit();"/><?php echo $msgstr["buscar_a"]?></button>
		</div>

	<?php  } ?>


	<?php 
	if (!isset($_REQUEST["submenu"]) or $_REQUEST["submenu"]!="N"){
		$archivo="";
		if (isset($_REQUEST["modo"])){
			if ($_REQUEST["modo"]=="integrado"){
				$archivo=$db_path."/opac_conf/".$lang."/indice.ix";
			}else{
				$archivo=$db_path.$_REQUEST["base"]."/opac/".$lang."/".$_REQUEST["base"].".ix";
			}
		}
	?>
	
	<?php if (file_exists($archivo)){ ?>
		<div class="col-auto">
			<button type="button" class="btn btn-light" onclick="showhide('sub_menu')"> <?php echo $msgstr["indice_alfa"];?></button>
		</div>
		
		<?php }  } ?>



		<div id="more" class="col-auto">
   			<input type=button class="btn btn-light" value="<?php echo $msgstr["diccionario"]?>" onclick="javascript:DiccionarioLibre(0)">
		</div>	


<?php
}
if (!isset($_REQUEST["submenu"]) or $_REQUEST["submenu"]!="N") {
?>

<div style="clear:both;"></div>
    <div id="sub_menu" style="display: none;" name=sub_menu>
		<ul>
<?php

$php_path="";
if ($multiplesBases=="S" and isset($_REQUEST["base"])){
	$base="base=".$_REQUEST["base"];
	$dbname=$_REQUEST["base"];
}else{
	$base="";
	$dbname="";
}


if (isset($Home))
	   echo "<li><a href=$Home>Home</a></li>\n";
$multipleBases="S";

if (isset($_REQUEST["modo"]) and $_REQUEST["modo"]=="integrado"){
	$archivo="indice.ix";
	$base="";
	$file_ix=$db_path."opac_conf/".$lang."/".$archivo;
}else{
	if (isset($_REQUEST["coleccion"]) and $_REQUEST["coleccion"]!=""){
		$col=explode("|",$_REQUEST["coleccion"]);
		$archivo=$_REQUEST["base"].'_'.$col[0].".ix";
		$file_ix=$db_path.$_REQUEST["base"]."/opac/".$lang."/".$archivo;
	}else{
		$archivo=$_REQUEST["base"].".ix";
		$file_ix=$db_path.$_REQUEST["base"]."/opac/".$lang."/".$archivo;
	}

	$base=$_REQUEST["base"];
}

if (file_exists($file_ix)){
	$fp=file($file_ix);
	foreach ($fp as $value){
		$val=trim($value);
		if ($val!=""){
			$v=explode('|',$val);
			if (isset($v[2]) and trim($v[2])!="")
				$columnas=$v[2];
			else
				$columnas=1;

			echo "<li><a href='Javascript:ActivarIndice(\"".str_replace("'","�",$v[0])."\",$columnas,\"inicio\",90,1,\"".$v[1]."\",\""."$base\")'>".$v[0]."</a></li>\n";
		}
	}
}
if (!isset($_REQUEST["base"]) or $_REQUEST["base"]==""){
	$archivo="libre.tab";
}else{
	$archivo=$_REQUEST["base"]."_libre.tab";
}
//echo $archivo;
if (!file_exists($db_path.$base."/opac/".$lang."/$archivo")){
	$prefijo="TW_";
}else{
	$fp=file($db_path.$base."/opac/".$lang."/$archivo");

	foreach ($fp as $linea){
		$linea=trim($linea);
		if ($linea!=""){
			$x=explode('|',$linea);
			$prefijo=$x[1];
			break;
		}
	}
}

?>

		</ul>
	</div>
    	<input type="hidden" name="Opcion" value="libre">
   		<input type="hidden" name="prefijo" value="<?php echo $prefijo;?>" >
   		<input type=hidden name=resaltar value="S">
   		<?php if (isset($_REQUEST["coleccion"])) {
   			echo "<input type=hidden name=coleccion value=\"".$_REQUEST["coleccion"]."\">\n";
   		}
   		?>
   	</form>

</div><!--/searchBox-->
</div>

<?php
}

if ($actualScript=="index.php") {
	unset($_REQUEST["base"]);
}
?>

