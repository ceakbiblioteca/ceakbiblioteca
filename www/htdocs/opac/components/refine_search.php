<?php if ($Expresion!='$'){  ?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title"><?php echo $msgstr["su_consulta"];?> <?php echo str_replace('"','',PresentarExpresion($base));?></h5>


	<?php if (!isset($_REQUEST["indice_base"]) or $_REQUEST["indice_base"]==0 or $_REQUEST["indice_base"]==1 ){ ?>
	    <p>    
			<a class="card-link" href="javascript:document.buscar.action='avanzada.php';document.buscar.submit();">
	            <i class="fa fa-filter"></i><?php echo $msgstr["afinar"];?>
	        </a>
		</p>

	<?php if (!isset($_REQUEST["indice_base"]) or $_REQUEST["indice_base"]==1){ ?>
	        <p>
				<a  class="card-link" href="javascript:document.buscar.indice_base.value=0;document.buscar.integrada.value='';document.buscar.coleccion.value='';document.buscar.submit();">
					<img src=../images/expansion.png height=20px> <?php echo $msgstr["buscar_en_todos"];?>
				</a>
			</p>
	        <?php
            }
		}
	    ?>
  </div>

</div>
	
	<?php
    }