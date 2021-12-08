<?php
/* Modifications
20210430 fho4abcd Removed duplicate header setting.Lineends
20211206 fho4abcd Full rewrite, include ifpro.php (with workaround from eds for truncated utf-8 last character) and ifepil.php
20211207 fho4abcd Improved buttons + comment "broken multi-byte end-character (semi-)solution" + html errors + remove <table>' + add working message
*/
// Show the dictionary of terms in the database

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();
if (!isset($_SESSION["permiso"])){
    header("Location: ../common/error_page.php") ;
}
include("../common/get_post.php");
//foreach ($arrHttp as $var => $value)     echo "$var = $value<br>";
include("../config.php");
include ("../lang/admin.php");
include ("leerregistroisispft.php");

// ------------------------------------------------------
// INICIO DEL PROGRAMA
// ------------------------------------------------------

include("../common/header.php");
?>
<body>
<script language=javascript>
function EjecutarBusqueda(desde){
    Opcion="<?php echo $arrHttp["Opcion"]?>"
    switch (desde){
        case 1:
            /* buscar los terminos de este diccionario*/
            TerminosSeleccionados=""
            document.forma1.Opcion.value="buscar_en_este"
            for (i=0;i<document.forma1.terminos.length;i++){
                if (document.forma1.terminos.options[i].selected==true){
                    /* 
                    ** (semi-)solution for broken multi-byte end-character
                    ** Replace with a truncation '$' the UTF8-character at the end when broken (corrupt) by the splitting in between LE1 and LE2
                    ** (resp. short and long terms max) in CISIS cifst.c code. 
                    */
                    Termino=document.forma1.terminos.options[i].value;
                    var index=Termino.indexOf(String.fromCharCode("65533"));
                    if(index>=0){
                        Termino=Termino.substring(0,index-1);
                        Termino+="$";
                    }
                    document.forma1.terminos.options[i].value=Termino

                    Termino="\""+document.forma1.terminos.options[i].value+"\""
                    if (TerminosSeleccionados==""){
                        TerminosSeleccionados=Termino
                    }else{
                        TerminosSeleccionados=TerminosSeleccionados+" or "+Termino
                    }
                }
            }
            document.forma1.Expresion.value=TerminosSeleccionados
            document.forma1.action="buscar.php"
            <?php
            if (isset($arrHttp["Tabla"])){
                  if ($arrHttp["Tabla"]=="cGlobal")
                      echo "document.forma1.action=\"c_global.php\"\n";
                  if ($arrHttp["Tabla"]=="imprimir")
                    echo "document.forma1.action=\"imprimir.php\"\n";
            }
            ?>
            document.forma1.submit()
            <?php
            if (isset($arrHttp["prestamo"]) or isset($arrHttp["Target"])) {
                echo " self.close()\n";
            }
            ?>
            break
        case 2:
            /* Pasar los t�rminos seleccionados */
            TerminosSeleccionados=""
            for (i=0;i<document.forma1.terminos.length;i++){
                if (document.forma1.terminos.options[i].selected==true){
                    Termino=document.forma1.terminos.options[i].value
                    len_t=<?php echo strlen($arrHttp["prefijo"])."\n"?>
                    Termino=Termino.substr(len_t)
                    Termino="\""+Termino+"\""
                    if (TerminosSeleccionados==""){
                        TerminosSeleccionados=Termino
                    }else{
                        TerminosSeleccionados=TerminosSeleccionados+" or "+Termino
                    }
                }
            }
            <?php
            if (!isset($arrHttp["toolbar"])){
                ?>
                a=window.opener.document.forma1.expre[document.forma1.Diccio.value].value
                if (a==""){
                    window.opener.document.forma1.expre[document.forma1.Diccio.value].value=TerminosSeleccionados
                }else{
                    window.opener.document.forma1.expre[document.forma1.Diccio.value].value=a+" or "+TerminosSeleccionados
                }
            <?php }else{ ?>
                Prefijo="<?php echo $arrHttp["prefijo"]?>"
                TerminosSeleccionados=TerminosSeleccionados.replace(/"/g,"")
                window.opener.document.forma1.busqueda_palabras.value=TerminosSeleccionados
                window.opener.Buscar(Prefijo)
            <?php }?>
            self.close()
            break
        case 4:
            /* M�s t�rminos */
            document.forma1.Opcion.value="mas_terminos"
            document.forma1.submit()
            break
        case 3:
            /* Continuar */
            document.forma1.Opcion.value="mas_terminos"
            document.forma1.LastKey.value=document.forma1.prefijo.value+document.forma1.IR_A.value
            document.forma1.submit()
            break
    }
}
function RemoveSpan(id){
    var workingspan = document.getElementById(id);
    workingspan.remove();
}
</script>
<div class="sectionInfo">
    <div class="breadcrumb">
        <?php echo $msgstr["indicede"].": ".urldecode($arrHttp["campo"])?>
    </div>
    <div class="actions">
    </div>
<div class="spacer">&#160;</div>
</div>
<?php
include "../common/inc_div-helper.php";
?>
<div class="middle form">
<div class="formContent">

<FORM METHOD="Post" name=forma1 action=diccionario.php onSubmit="Javascript:return false">
<input type=hidden name=Opcion value='<?php echo $arrHttp["Opcion"]?>'>
<input type=hidden name=session_id value='<?php if (isset($arrHttp["session_id"])) echo $arrHttp["session_id"]?>'>
<input type=hidden name=base value='<?php echo $arrHttp["base"]?>'>
<input type=hidden name=cipar value='<?php echo $arrHttp["cipar"]?>'>
<input type=hidden name=Expresion value=''>
<input type=hidden name=prefijo value='<?php echo $arrHttp["prefijo"]?>'>
<input type=hidden name=Diccio value='<?php echo $arrHttp["Diccio"]?>'>
<input type=hidden name=desde value='<?php if (isset($arrHttp["desde"])) echo $arrHttp["desde"]?>'>
<input type=hidden name=toolbar value='<?php if (isset($arrHttp["toolbar"])) echo $arrHttp["toolbar"]?>'>
<input type=hidden name=campo value="<?php echo urldecode($arrHttp["campo"])?>">
<?php
if (isset($arrHttp["prestamo"])) {
    echo "<input type=hidden name=prestamo value=".$arrHttp["prestamo"].">";
  }
if (isset($arrHttp["Tabla"])) {
    echo "<input type=hidden name=Tabla value=".$arrHttp["Tabla"].">";
 }
if (isset($arrHttp["Target"])) {
    echo "<input type=hidden name=Target value=".$arrHttp["Target"].">";
}
?>
    <div><?php echo $msgstr["selmultiple"];?></div>
    <div>
        <input type=text name="IR_A" size=15>&nbsp;<?php echo $msgstr["src_advance"];?>
        <input type="submit" style="display:none;" onclick="EjecutarBusqueda(3)"/>
    </div>
    <div>
        <span id="working" style="color:red"><b>.... <?php echo $msgstr["src_system_working"]?> ....</span>
        <?php  ob_flush();flush();?>
        <select name=terminos  size=13 multiple 
            <?php
            // When the function is initiated from the toolbar a hit will search immediately
            if (isset($arrHttp["toolbar"])) {
                if ($arrHttp["Opcion"]=="diccionario"){
                    echo 'onclick="EjecutarBusqueda(1)"'; 
                } else {
                    echo 'onclick="EjecutarBusqueda(2)"';
                }
            }
            echo ">";
            PresentarDiccionario();
            ?>
        </select>
        <script> RemoveSpan("working");</script>
        <INPUT TYPE=HIDDEN VALUE="<?php echo $arrHttp["LastKey"]?>" NAME="LastKey">
    </div>
    <div class="ActionFooter"  style='text-align:center'>
        <a href="javascript:EjecutarBusqueda(4)" class="bt bt-gray">
             <i class="fas fa-chevron-circle-down"></i> <?php echo $msgstr["masterms"]?>
        </a>
        <?php
        $showsend=true;
        if (isset($arrHttp["toolbar"])) $showsend=false;
        $showsearch=true;
        if (isset($arrHttp["Target"])) $showsearch=false;// Si existe $arrHttp["Target"] no se realiza la b�squeda directamente
    
        if ($showsend) {
        ?>
            &nbsp;&nbsp;
            <a href="javascript:EjecutarBusqueda(2)" class="bt bt-blue">
                 <i class="fas fa-share-square"></i> <?php echo $msgstr["src_send"]?>
            </a>
        <?php
        }
        if ($showsearch) {
        ?>
            &nbsp;&nbsp;
            <a href="javascript:EjecutarBusqueda(1)" class="bt bt-green">
                 <i class="fas fa-search"></i> <?php echo $msgstr["buscar"]?>
            </a>
        <?php } ?>
    </div>
</form>
</div>
</div>
<?php
include("../common/footer.php");
// ======================================================
// This the end of main script. Only functions follow now
//
// ====== PresentarDiccionario ==========================
// Para presentar el diccionario de t�rminos
// To present the dictionary of terms

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
    $query = "&base=".$arrHttp["base"]."&cipar=$db_path"."par/".$arrHttp["cipar"]."&Opcion=".$arrHttp["Opcion"]."&prefijo=".$arrHttp["prefijo"]."&LastKey=".$LastKey;
    $contenido=array();
    include("../common/wxis_llamar.php");
    $mayorclave="";
    foreach ($contenido as $linea){
        $pre=trim(substr($linea,0,strlen($arrHttp["prefijo"])));
        if ($pre==$arrHttp["prefijo"]){
            $l=explode('|',$linea);
            $ter=substr($l[0],strlen($arrHttp["prefijo"]));
            $ter=trim($ter);
            $ttll=trim($l[0]);
            echo "<option value=\"".$ttll."\">".$ter;
            if (isset($l[1])) echo " (".trim($l[1]).")";
            echo "</option>\n";
            $mayorclave=$l[0];
        }
    }
    $arrHttp["LastKey"]=$mayorclave;
}
?>
