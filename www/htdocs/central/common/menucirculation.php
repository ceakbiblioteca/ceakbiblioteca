<?php
include_once("../config.php");
/*echo "$db_path";
if (file_exists($db_path."logtrans/data/logtrans.mst") and $_SESSION["MODULO"]!="loan"){
	include("../circulation/grabar_log.php");
	$datos_trans["operador"]=$_SESSION["login"];
	GrabarLog("P",$datos_trans,$Wxis,$xWxis,$wxisUrl,$db_path);

}
*/
$_SESSION["MODULO"]="loan";
global $arrHttp,$msgstr,$db_path,$valortag,$lista_bases;
?>
			<div class="mainBox" >
				<div class="boxContent loanSection">
					<div class="sectionIcon">
						&#160;
					</div>
					<div class="sectionTitle">
						<h4>&#160;<strong><?php echo $msgstr["trans"]?></strong></h4>
					</div>
					<div class="sectionButtons">
<?php

if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_LOAN"])){
?>
						<a href="../circulation/prestar.php?encabezado=s" class="menuButton loanButton">
							<span><strong><?php echo $msgstr["loan"]?></strong></span>
						</a>
<?php
	if (isset($ILL) and $ILL!="") {
?>
						<a href="../circulation/interbib.php?encabezado=s" class="menuButton providersButton">
							<span><strong><?php echo $msgstr["r_ill"]?></strong></span>
						</a>
<?php
	}
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_LOAN"])){
	if (!isset($reserve_active) or isset($reserve_active) and $reserve_active=="Y"){
?>
						<a href="../circulation/estado_de_cuenta.php?encabezado=s&reserve=S" class="menuButton reserveButton">
							<span><strong><?php echo $msgstr["reserve"]?></strong></span>
						</a>
<?php
	}
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_RETURN"])){
?>
						<a href="../circulation/devolver.php?encabezado=s" class="menuButton returnButton">
							<span><strong><?php echo $msgstr["return"]?></strong></span>
						</a>
<?php
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_RENEW"])){
?>
						<a href="../circulation/renovar.php?encabezado=s" class="menuButton renewButton">
							<span><strong><?php echo $msgstr["renew"]?></strong></span>
						</a>
<?php
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_SALA"])){
?>
						<a href="../circulation/sala.php?encabezado=s" class="menuButton exploreButton">
							<span><strong><?php echo $msgstr["sala"]?></strong></span>
						</a>
<?php }
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_SUSPEND"])){
?>
						<a href="../circulation/sanctions.php?encabezado=s" class="menuButton sanctionsButton">
							<span><strong><?php echo $msgstr["suspend"]."/".$msgstr["fine"]?></strong></span>
						</a>
<?php }?>
						<a href="../circulation/situacion_de_un_objeto.php?encabezado=s" class="menuButton statusitemButton">
							<span><strong><?php echo $msgstr["ecobj"]?></strong></span>
						</a>
						<a href="../circulation/estado_de_cuenta.php?encabezado=s" class="menuButton userstatmentButton">
							<span><strong><?php echo $msgstr["statment"]?></strong></span>
						</a>
                        <a href="../circulation/borrower_history.php?encabezado=s" class="menuButton userhistoryButton">
							<span><strong><?php echo $msgstr["bo_history"]?></strong></span>
						</a>
						<a href="../circulation/item_history.php?encabezado=s" class="menuButton receivingButton">
							<span><strong><?php echo $msgstr["item_history"]?></strong></span>
						</a>
						<a href="../output_circulation/menu.php" class="menuButton reportsButton">
							<span><strong><?php echo $msgstr["reports"]?></strong></span>
						</a>
					</div>
					<div class="spacer">&#160;</div>
				</div>
			</div>
<?php
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCDATABASES"])){
?>
			<div class="mainBox" >

				<div class="boxContent titleSection">
					<div class="sectionIcon">
						&#160;
					</div>
					<div class="sectionTitle">
						<h4>&#160;<strong><?php echo $msgstr["basedatos"]?></strong></h4>
					</div>
					<div class="sectionButtons">
						<a href="../dataentry/browse.php?base=users&modulo=loan" class="menuButton userButton">
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["users"]?></strong></span>
						</a>
						<a href="../dataentry/browse.php?base=trans&modulo=loan" class="menuButton transactionsButton">
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["trans"]?></strong></span>
						</a>
						<a href="../dataentry/browse.php?base=suspml&modulo=loan" class="menuButton sanctionsButton">
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["suspen"]."/".$msgstr["multas"]?></strong></span>
						</a>
<?php
	if (!isset($reserve_active) or isset($reserve_active) and $reserve_active=="Y"){
?>
						<a href="../dataentry/browse.php?base=reserve&modulo=loan" class="menuButton reserveButton">
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["reservas"]?></strong></span>
						</a>
<?php } ?>
					</div>
					<div class="spacer">&#160;</div>
				</div>
			</div>
<?php
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCFG"])
	or isset($_SESSION["permiso"]["CIRC_CIRCREPORTS"]) or isset($_SESSION["permiso"]["CIRC_CIRCSTAT"])){
?>

            <div class="mainBox" >

				<div class="boxContent toolSection">
					<div class="sectionIcon">
						&#160;
					</div>
					<div class="sectionTitle">
						<h4>&#160;<strong><?php echo $msgstr["admin"]?></strong></h4>
					</div>
					<div class="sectionButtons">
<?php
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_CIRADMIN"])){
?>                      <!--a href="javascript:VerificarInicializacion()" class="menuButton databaseButton" on>
						<a href="../circulation/menu_mantenimiento.php" class="menuButton databaseButton" on>
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["basedatos"]?></strong></span>
						</a-->
<?php
}

if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCFG"])){
?>
						<a href="../circulation/configure_menu.php?encabezado=s" class="menuButton toolsButton">
							<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
							<span><strong><?php echo $msgstr["configure"]?></strong></span>
						</a>
<?php
}
if (isset($_SESSION["permiso"]["CENTRAL_ALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCALL"]) or isset($_SESSION["permiso"]["CIRC_CIRCSTAT"])){
?>
			<a href="../statistics/tables_generate.php?base=users&encabezado=s" class="menuButton statisticsusersButton">
				<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
				<span><strong><?php echo $msgstr["stat_users"]?></strong></span>
			</a>
			<a href="../statistics/tables_generate.php?base=trans&encabezado=s" class="menuButton statButton">
				<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
				<span><strong><?php echo $msgstr["stat_trans"]?></strong></span>
			</a>
			<a href="../statistics/tables_generate.php?base=suspml&encabezado=s" class="menuButton statisticsanctionsButton">
				<img src="../../assets/images/mainBox_iconBorder.gif" alt="" title="" />
				<span><strong><?php echo $msgstr["stat_suspml"]?></strong></span>
			</a>
<?php

}
?>
				</div>
					<div class="spacer">&#160;</div>
				</div>

			</div>
<?php }?>
<script>
function VerificarInicializacion(){
	if (confirm("Quiere inicializar las transacciones de pr�stamo")){
		self.location.href="../circulation/initialize_trans.php?encabezado=s"
	}
}
</script>