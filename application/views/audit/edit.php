<?php
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>

<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
	<? include_once('tabs.php');
#	if ($_SESSION["user"]["role"] == PROVEEDOR) { $readonly = ""; } else { $readonly = " readonly='readonly'"; }
	if ($editedRequirement["status"] == OK) { $okChecked = ' checked'; } else { $okChecked = ''; }
	if ($editedRequirement["status"] == NC) { $ncChecked = ' checked'; } else { $ncChecked = ''; }  ?>

	<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
		<div id="left50">
			<form action="<?=SITE_URL?>audit/save/<?=$editedRequirement["id"]?>" method="post">
				<p>
					<label for="textfield"><strong><?=LBL_DESCRIPTION?></strong></label>
					<?=$editedRequirement["number"]?> - <?=$editedRequirement["description"]?><br>
				</p>
				<p>
					<label for="observance"><strong><?=LBL_OBSERVANCECOMMENTS?></strong></label>
					<ul id="archivos" style="margin-top:-15px; font-size:11px;">
						<? if(!empty($comentarios_pros)){
							foreach($comentarios_pros as $comentarios_pro){
								?><li><?=trim($comentarios_pro['comentario'])?> <span style="font-style:italic; font-size:12px; font-weight:bold;">Registrado por <?=$comentarios_pro['fullname']?> el <?=$comentarios_pro['fecha']?></span></li><? 
							}
						} else {
							?><li>No hay comentarios introducidos por el proveedor</li><? 
						} ?>
					</ul>
				</p><br />
				<?php if($_SESSION["user"]["role"] !== '3' ){ ?>
				<p>
						<?php if($_SESSION["user"]["role"] !== '5' ){ ?>
					<label for="audit"><strong><?=LBL_AUDITCOMMENTS?></strong></label>
					<ul id="archivos" style="margin-top:-15px; font-size:11px;">
							<? if(!empty($comentarios_auds)){
								foreach($comentarios_auds as $comentarios_aud){
									?><li><?=trim($comentarios_aud['comentario'])?> <span style="font-style:italic; font-size:12px; font-weight:bold;">Registrado por <?=$comentarios_aud['fullname']?> el <?=$comentarios_aud['fecha']?></span></li><? 
								}
							} else {
								?><li>No hay comentarios introducidos por el auditor</li><? 
							} ?>
					</ul>
						<?php } ?>	
				</p><br /><br />
				<p> <?php //$arraryCap =  explode(".", $editedRequirement["number"]); ?>
					 <textarea type="text" id="comentarios"  name="comentarios" class="inputarea correctarea"></textarea> 
				</p>
				<?php } ?>
				<!-- <p class="radios">
					<?php if ($_SESSION["user"]["role"] == '0' || $_SESSION["user"]["role"] == '1' || $_SESSION["user"]["role"] == '3') { $readonly = ""; } else { $readonly = " disabled='disabled'"; ?>
					<input type="hidden" name="status" value="<?=$editedRequirement["status"]?>">
					<?php } ?>
					<input type="radio" name="status" value="<?=OK?>" <?=$okChecked?><?=$readonly?>> OK
					<input type="radio" name="status" value="<?=NC?>" <?=$ncChecked?><?=$readonly?>> NC
					<?php
						$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
						$bd = mysql_select_db(DB_NAME) or die ("Verifique la Base de Datos");
						$query = "SELECT * FROM okperfilaudit WHERE  id_rData = ".$editedRequirement["id"];
						$res = mysql_query($query);
						$reg = mysql_fetch_array($res);
						if(!empty($reg)){
							$solChecked = ' checked';
							$solreadonly = " disabled='disabled'";
						}else{
							$solChecked = '';
							$solreadonly = "";
						}
					?>
					<input type="checkbox" name="sol" value="<?=$editedRequirement["id"]?>" <?=$solChecked?><?=$readonly?>> Solucionado?<br/>
				</p> -->
				<?php if($_SESSION["user"]["role"] !== '3' ){ ?>
				<p class="buttons">
					<input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
				</p>
				<?php } ?> 
                
			</form>
		</div>
		

		<div id="right50">
			<form enctype="multipart/form-data" action="<?=SITE_URL?>audit/upload/<?=$id?>" method="POST">
				<div style="margin-left:50px;">
					<strong>Archivos Anexos:</strong>
					<ul id="archivos">
						<? if(!empty($archives)){
							foreach($archives as $archive){
								?>								<li>									<a href="../../archivos/<?=$archive['id']?>.<?=$archive['extension']?>"><?=$archive['nombre']?></a>&nbsp;									<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>									<a href="<?=SITE_URL?>audit/delupload/<?=$archive["id"]?>">X</a>									<? endif; ?>								</li>								<? 
							}
						} else {
							?><li>No hay archivos cargados</li><? 
						} ?>
					</ul>
					
					<br /><br />
				<?php if($_SESSION["user"]["role"] !== '3' ){ ?>
					<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
					<input name="uploadedfile" type="file" /><br /><br /><br />
					<?php } ?>
				</div>
				<?php if($_SESSION["user"]["role"] !== '3' ){ ?>
				<div align="right" style="margin-right:20px;">
					<input type="submit" value="Cargar Archivo" class="btnalt" />
				</div>
				<?php } ?>
			</form>
		</div>
		
	</div>
</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>