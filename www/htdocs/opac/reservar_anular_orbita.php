<?php
//foreach ($_REQUEST AS $var=>$value) echo "$var=$value<br>";  die;
include("../central/config_opac.php");
chdir($CentralPath."circulation");
$desde_opac="Y";
$vienede="ABCD";
include ('reservar_anular.php');

?>