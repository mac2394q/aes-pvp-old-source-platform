<?

require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>

<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
	<? include_once('tabs.php'); ?>
	<div id="left50">
		<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
			<? if ($auditInstance["reportedDate"] == null) { ?>
				<div class="status warning">
					<p class="closestatus"><a href="#" title="Close">x</a></p>
					<p>
						<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_warning.png" alt="Advertencia">
						<span><?=LBL_WARN?></span> <?=WARN_NO_REPORT?>
					</p>
				</div>
			<?php } else {?>
				<div class="status warning"> 
					<p>
						<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_warning.png" alt="Advertencia">
						<span><?=LBL_WARN?></span> <?=WARN_REPORTED?>&nbsp;&nbsp;<a href="<?=SITE_URL?>audit/wordplan/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>" target="_BLANK">Ver Reporte</a>
					</p>
				</div>
			<?php } ?>
            		
			
			<form action="<?=SITE_URL?>audit/savecomplimentary/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>" method="post">
			<? $i = 1;?>
			<? foreach($complimentaryRequirements as $requirement): ?>
				<p>
					<strong><?=$requirement["number"]?> - <?=$requirement["description"]?></strong><br />
				</p>
				<p>
					<label for="observance"><strong><?=LBL_OBSERVANCECOMMENTS?></strong></label>
					<?
					$con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
					$bd = mysql_select_db(DB_NAME) or die ("Verifique la Base de Datos");
					$query = "SELECT * FROM `perfil_comentarios` WHERE rData_id = ".$requirement["id"];
					$res = mysql_query($query);
					while($reg = mysql_fetch_array($res)){
							if(!empty($reg["comentario"]) && $reg["proveedor_id"] != 0) { ?>
								<?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span><br/>
						<? 	} ?>
					<? 	} ?>
				</p>
				<p>
					<label for="audit"><strong><?=LBL_AUDITCOMMENTS?></strong></label>
					<?
					$res = mysql_query($query);
					while($reg = mysql_fetch_array($res)){
							if(!empty($reg["comentario"]) && $reg["auditor_id"] != 0) { ?>
								<?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span><br/>
						<? 	} ?>
					<? 	} ?>
				</p>
				<p>
					<label for="audit"><strong><?=LBL_REPORTCOMMENTS?></strong></label>
				<?
					$query = "SELECT * FROM `reportcoments` WHERE id_rData = ".$requirement["id"];
					$res = mysql_query($query);
					while($reg = mysql_fetch_array($res)){
						echo $reg["reportComment"]." <font size='1'><strong><i>".$reg["fecha"]."</i></strong></font><br/>";
					}
				?>
				</p>
				<p>
					<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == PROVEEDOR) { $readonly = ""; } else { $readonly = " readonly='readonly'"; } ?>
					<label for="audit"><strong><?=LBL_COMPLIMENTARYCOMMENTS?></strong></label>
					<?
					$query  = "SELECT * ";
					$query .= "FROM plancoments pl ";
					$query .= "LEFT JOIN users u ";
					$query .= "ON pl.user_id = u.id ";
					$query .= "WHERE pl.id_rData = ".$requirement["id"];
					$res = mysql_query($query);
					while($reg = mysql_fetch_array($res)){
						echo $reg["planComment"]." <font size='1'><strong><i>Registrado por</i></strong></font> ". $reg["username"] ." <font size='1'><strong><i> en ".$reg["fecha"]."</i></strong></font><br/>";
					}
					?>
					<textarea type="text" name="reportComments_<?php echo $i;?>" class="inputarea correctarea" <?=$readonly?>></textarea>
					<input type="hidden" name="id_requirement_<?php echo $i;?>" value="<?php echo $requirement["id"];?>"/>
					<input type="hidden" name="requirementId[]" value="<?=$requirement["id"]?>">
					<?
					$query = "SELECT * FROM statusplanaudit WHERE id_rData = ".$requirement["id"];
					$res = mysql_query($query);
					$reg = mysql_fetch_array($res);
					if ($reg["status"] == OK) { $okChecked = ' checked="checked"'; } else { $okChecked = ''; }
					if ($reg["status"] == NC) { $ncChecked = ' checked="checked"'; } else { $ncChecked = ''; }
					if ($requirement["isCritical"] == true) { $criticalChecked = ' checked="checked"'; } else { $criticalChecked = ''; }
				
					if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR) { $readonly = ""; } else { $readonly = " disabled='disabled'"; }
					?>
					<input type="radio" name="status[<?=$requirement["id"]?>]" value="<?=OK?>" <?=$okChecked?><?=$readonly?> /> Ok
					<input type="radio" name="status[<?=$requirement["id"]?>]" value="<?=NC?>" <?=$ncChecked?><?=$readonly?> /> NC
					<input type="checkbox" name="isCritical[<?=$requirement["id"]?>]" value="<?=$requirement["id"]?>" <?=$criticalChecked?><?=$readonly?> />Cr&iacute;tico
				</p>
				<p class="separator"></p>
				<? $i++;?>
				<? endforeach;

				if ($auditInstance["reportedDate"] != null || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == PROVEEDOR) { ?>
					<p class="buttons">
						<input type="hidden" name="contador" value="<?php echo $i;?>" />
						<input type="submit" value="<?=LBL_SAVE?>" class="btnalt" />
					</p>
				<? } ?>
			</form>
		</div>
	</div>

	<div id="right50">
		<form enctype="multipart/form-data" action="<?=SITE_URL?>audit/cupload/<?=$auditInstance["id"]?>" method="POST">
			<div style="margin-left:50px;">
				<strong>Archivos Anexos:</strong>
				<ul id="archivos">
					<? if(!empty($archives)){
						foreach($archives as $archive){
							?>
							<li>
								<a href="../../archivos/<?=$archive['id']?>.<?=$archive['extension']?>"><?=$archive['nombre']?></a>&nbsp;
								<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>
								<a href="<?=SITE_URL?>audit/delupload/<?=$archive["id"]?>">X</a>
								<? endif; ?>
							</li>
							<? 
						}
					} else {
						?><li>No hay archivos cargados</li><? 
					} ?>
				</ul>
				
				<br /><br />
			
				<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
				<input name="uploadedfile" type="file" /><br /><br /><br />
			</div>
			
			<div align="right" style="margin-right:20px;">
				<input type="submit" value="Cargar Archivo" class="btnalt" />
			</div>
		</form>
	</div>
</div>

<?
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>