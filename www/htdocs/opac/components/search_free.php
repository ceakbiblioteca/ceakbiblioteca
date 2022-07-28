<?php
/**
 * 20220307 rogercgui fixed index $prefijo=$x[1];
 * 
 */

?>

  <div class="container-fluid shadow">
    <div class="row">
      <div class="bg-light col-md-3 col-lg-2">
    <nav class="col-md-12 col-lg-12 bg-light d-xl-inline sidebar">
      <div class="position-sticky pt-3">
        <ul class="nav flex-md-column flex-xl-row">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Free Search
            </a>
          </li>
	<?php
		if (!isset($BusquedaAvanzada) or isset($BusquedaAvanzada) and $BusquedaAvanzada=="S"){
	?>		  
          <li class="nav-item">
            <a class="nav-link" aria-current="page" onclick="javascript:document.libre.action='avanzada.php';document.libre.submit();">
              <span data-feather="home" class="align-text-bottom"></span>
              <?php echo $msgstr["buscar_a"]?>
            </a>
          </li>
<?php } ?>		  
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="javascript:DiccionarioLibre(0)">
              <span data-feather="file" class="align-text-bottom"></span>
              <?php echo $msgstr["diccionario"]?>
            </a>
          </li>
	<?php
	if (!isset($_REQUEST["submenu"]) or $_REQUEST["submenu"]!="N"){
		$archivo="";
		if (isset($modo)){
			if ($modo=="integrado"){
				$archivo=$db_path."/opac_conf/".$lang."/indice.ix";
			}else{
				$archivo=$db_path.$_REQUEST["base"]."/opac/".$lang."/".$_REQUEST["base"].".ix";
			}
		}
		if (file_exists($archivo)){
		?>	
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showhide('sub_menu')">
              <span data-feather="file" class="align-text-bottom"></span>
              <?php echo $msgstr["indice_alfa"];?>
            </a>
          </li>			
		
		<?php
		}
	}
?>		  
        </ul>
    
      </div>
    </nav>
      </div>

      <div class="bg-light col-md-9 col-lg-10">

	  <?php
if (!isset($mostrar_libre) or $mostrar_libre!="N"){
?>

		<form method="post" action="buscar_integrada.php" name="libre">

	<?php
	if (isset($_REQUEST["db_path"]))     echo "<input type=hidden name=db_path value=".$_REQUEST["db_path"].">\n";
	if (isset($_REQUEST["lang"]))     echo "<input type=hidden name=lang value=".$_REQUEST["lang"].">\n";
    if (isset($_REQUEST["Formato"]))echo "<input type=hidden name=indice_base value=".$_REQUEST["Formato"].">\n";
    if (isset($_REQUEST["indice_base"]))echo "<input type=hidden name=indice_base value=".$_REQUEST["indice_base"].">\n";
	if (isset($_REQUEST["base"]))echo "<input type=hidden name=base value=".$_REQUEST["base"].">\n";
	if (isset($modo))echo "<input type=hidden name=modo value=".$modo.">\n";
	?>		
        <div class="input-group p-xl-5 p-md-4">
          <input type="text" class="form-control form-control-lg" name="Sub_Expresion" id="search-text"
            placeholder="<?php echo $msgstr["search"]?>..." aria-label="<?php echo $msgstr["search"]?>..." aria-describedby="button-addon2">
			

<?php
if (!isset($titulo_pagina)){
	//if (isset($_REQUEST["indice_base"]) and $_REQUEST["indice_base"]=="") unset($_REQUEST["integrada"]);
	if (isset($modo) and  $modo=="integrado"){
	?>	
	<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false"><?php echo $msgstr["todos_c"];?></button>
		<input type="hidden" name="modo" value="integrado">
	<?php
	}else{
		if (isset($_REQUEST["base"]) and $_REQUEST["base"]!=""){
			echo '<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">'.$bd_list[$_REQUEST["base"]]["titulo"];
			$yaidentificado="S";
			if (isset($_REQUEST["coleccion"]) and $_REQUEST["coleccion"]!="") {
				$_REQUEST["coleccion"]=urldecode($_REQUEST["coleccion"]);
				$cc=explode('|',$_REQUEST["coleccion"]);
				echo "<i>".$cc[1]."</i>";
			}
		}
	}
	echo "</button>";
}
?>


              <ul class="dropdown-menu">
				<input type="hidden" name="modo" value="integrado">
<?php
	foreach ($bd_list as $key => $value){
		$archivo=$db_path.$key."/opac/".$lang."/".$key."_colecciones.tab";
		$ix=0;
		$value_info="";
		$home_link="*";
		if (file_exists($db_path."opac_conf/".$lang."/".$key."_home.info")){
			$home_info=file($db_path."opac_conf/".$lang."/".$key."_home.info");
			foreach ($home_info as $value_info){
				$value_info=trim($value_info);
				if ($value_info!=""){
					if (substr($value_info,0,6)=="[LINK]") $home_link=$value_info;
					if (substr($value_info,0,6)=="[TEXT]") $home_link=$value_info;
					if (substr($value_info,0,5)=="[MFN]")  $home_link="";
				}
				//echo "**$value_info<br>";
			}
		}
		if (trim($value["nombre"])!=""){
			echo "<a href='javascript:BuscarIntegrada(\"$key\",\"\",\"libre\",\"\$\",\"\",\"\",\"\",\"\",\"\",\"$home_link\")'>";
			echo "<strong>".$value["titulo"]."</strong></a><br>\n";
	    	if (file_exists($archivo)){
	    		$fp=file($archivo);
	    		echo "<ul>\n";

	    		foreach ($fp as $colec){
	          		$colec=trim($colec);
	          		if ($colec!=""){
	          			$v=explode('|',$colec);
	          			$ix=$ix+1;
	          			if ($v[0]!='<>'){
							if (isset($IndicePorColeccion) and $IndicePorColeccion=="S")
								$cipar="_".strtolower($v[0]);
							else
								$cipar="";
							echo "<li>";
							echo "<a href='javascript:BuscarIntegrada(\"$key\",\"1B\",\"libre\",\"\",\"$colec\",\"\",\"\",\"\",\"\",\"\")'>";
							//echo "<a href=\"buscar_integrada.php?base=$key&cipar=$key".$cipar."&coleccion=$colec&Opcion=libre\">"
			          		echo $v[1]."</a></li>\n";
	          			}else{
		          				//echo "<li>".$v[1]."</i></label></a></li>\n";
		        		}
		          	}
	          	}
	          	echo "</ul>\n";
	    	}else{
	    		//echo "</li>\n";
	   		}
	     }

	}
?>
                <li><a class="dropdown-item" href="#"><?php echo $msgstr["todos_c"];?></a></li>
                <li><a class="dropdown-item" href="#">MARC</a></li>
                <li><a class="dropdown-item" href="#">Dublin Core</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
              </ul>
          <button class="btn btn-success" type="button" id="button-addon2"><?php echo $msgstr["search"]?></button>
        </div>
		<div class="row mx-5 py-3">
			<?php echo $msgstr["resultados_inc"]?>: 
     		<div class="form-check">
     			<input class="form-check-input" type="radio" value="and" name="alcance" id="and">
    			<label class="form-check-label"><?php echo $msgstr["todas_p"]?> </label>
			</div>
			<div class="form-check">
    			<input class="form-check-input" type="radio" value="or" name="alcance" id="or"  checked>
    			<label class="form-check-label"><?php echo $msgstr["algunas_p"]?></label>
			</div>
   		</div><!--/more-->		
      </div>
	  
    </div>

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

if (isset($modo) and $modo=="integrado"){
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

   	<div style="clear:both;"></div>

<?php
}

if ($actualScript=="index.php") {
	unset($_REQUEST["base"]);
}
?>

</div><!--/searchBox-->