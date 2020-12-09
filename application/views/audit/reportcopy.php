<?php
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');

$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$bd = mysql_select_db(DB_NAME,$con) or die ("Verifique la Base de Datos");
?>

<?php 
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'audit' . DS .'audit_cap.php');	
		
		$totalcu = 0;
		$totalnc = 0;
//print_r($requirementsReport);
		if(!empty($requirementsReport)){
			foreach ($arrayCap as $values) {
					$totalcu += $values[1];
					$totalnc += $values[2];
			}
		}
		//print_r($arrayCap);die;
		//print $totalcu;
?>

<script type="text/javascript">
      google.load("visualization", "1", {
      	packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Cumplen',     <?php print $totalcu; ?>],
          ['No Cumplen',    <?php print $totalnc; ?>],
        ]);

        var options = {
          title: 'Estado de la auditoria',
          is3D: true,
          backgroundColor: '#eaeaea',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
	<?php include_once('tabs.php'); ?>

	<div id="left50">
		<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
		<?php if ($auditInstance["plannedDate"] == null) { ?>
			<div class="status warning">
				<p>
					<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_warning.png" alt="Advertencia">
					<span><?=LBL_WARN ?></span> <?=WARN_NO_PLAN?>
				</p>
			</div>
		<?php } else {
			if ($auditInstance["reportedDate"] != null) { ?>
				<div class="status warning">
					<p>
						<img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/icon_warning.png" alt="Advertencia">
						<span><?=LBL_WARN?></span> <?=WARN_REPORTED?>&nbsp;&nbsp;<a href="<?=SITE_URL?>audit/word/<?=$auditInstance['id']?>?y=<?php print date("Y"); ?>" target="_BLANK">Ver Reporte</a>
					</p>
				</div>
		<?php } 
		} 
		if(!empty($requirementsReport)){
			if($totalcu > 0 or $totalnc > 0){
		?>
		<div id="piechart_3d" style="width: auto; height: 500px;"></div>
		<a href="<?=SITE_URL?>audit/statusaudit/<?=$auditInstance['id']?>" style="display:block;text-align:center;margin:0 0 30px;" target="_blank">Ver detalle del estado de la  auditoria</a>
		<?php } 
		}
		?>
		<form action="<?=SITE_URL?>audit/savereport/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>" method="post">
		<?php 
			$Cumplen = 0;
			$Nocumplen = 0;
			$na = 0;
			$nd = 0;
			$TOTAL = 0;

			//print_r($requirementsReport);

		?> 
		<?php foreach($requirementsReport as $requirement): ?>
			<p>
				<strong><?=$requirement["number"]?> - <?=$requirement["description"]?></strong><br />
			</p>
			
				<label for="observance"><strong><?=LBL_OBSERVANCECOMMENTS?></strong></label>
				<?php   
						
						$query = "SELECT * FROM `perfil_comentarios` WHERE rData_id = ".$requirement["id"];
						$res = mysql_query($query);
						while($reg = mysql_fetch_array($res)){
				?>
				<?php  		if(!empty($reg["comentario"]) && $reg["proveedor_id"] != 0) { ?>
								<p><?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span><br/></p>
				<?	 		} 
						}
						@mysql_data_seek($res, 0);
							//print $requirement["id"]; //echo $reg["proveedor_id"];
				?>
			
						<?php 	if(mysql_num_rows($res) > 1) { ?>
							<label for="audit"><strong><?=LBL_AUDITCOMMENTS?></strong></label>
							<?php 	} 
						while($reg = mysql_fetch_array($res)){
							if(!empty($reg["comentario"]) && $reg["auditor_id"] != 0) { ?>
								
								<p><?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span><br/></p>
						<?php 	} ?>
					<?php  } ?>
			
			<p>
			<?php if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR ) { $readonly = ""; } else { $readonly = " readonly='readonly'"; } ?>
				<label for="audit"><strong><?=LBL_REPORTCOMMENTS?></strong></label>
				<?
					$query = "SELECT * FROM `reportcoments` WHERE id_rData = ".$requirement["id"];
					$res = mysql_query($query);
					while($reg = mysql_fetch_array($res)){
						echo $reg["reportComment"]." <strong><i>".$reg["fecha"]."</i></strong><br/>";
					}
				?>
				<textarea type="text" name="reportComments[<?=$requirement["id"]?>]" class="inputarea correctarea" <?=$readonly?>></textarea>
				<input type="hidden" name="requirementId[]" value="<?=$requirement["id"]?>">
				<?
					$query = "SELECT * FROM statusreportaudit WHERE id_rData = ".$requirement["id"];
					$res = mysql_query($query);
					$reg = mysql_fetch_array($res);
					if ($reg["status"] == OK) { $Cumplen++; $OKChecked = ' checked="checked"'; } else { $OKChecked = ''; }
					if ($reg["status"] == ND) { $nd++; }
					if ($reg["status"] == NA) { $na++;$NAChecked = ' checked="checked"'; } else { $NAChecked = ''; }
					if ($reg["status"] == NC) { $Nocumplen++; $NCChecked = ' checked="checked"'; } else { $NCChecked = ''; }
					if ($requirement["isCritical"] == true) { $CriticalChecked = ' checked="checked"'; } else { $CriticalChecked = ''; }
					if ($requirement["sol"] == true) { $solChecked = ' checked="checked"'; } else { $solChecked = ''; }
				
					if ($requirement["status"] == OK) { $okChecked = '<br/>Este item se encuentra OK en el perfil de seguridad'; } else { $okChecked = ''; }
					if ($requirement["status"] == NA) { $naChecked = '<br/>Este item se encuentra NA en el perfil de seguridad'; } else { $naChecked = ''; }
					if ($requirement["status"] == NC) { $ncChecked = '<br/>Este item se encuentra NC en el perfil de seguridad'; } else { $ncChecked = ''; }
					if ($requirement["isCritical"] == true) { $criticalChecked = '<br/>Este item es Cr&iacute;tico en el perfil de seguridad'; } else { $criticalChecked = ''; } 
					if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR) { $readonly = ""; } else { $readonly = " disabled='disabled'"; 
				?>
					<input type="hidden" name="status[<?=$requirement["id"]?>]" value="<?=$requirement["status"]?>">
					<input type="hidden" name="isCritical[<?=$requirement["id"]?>]" value="<?=$requirement["isCritical"]?>">
				<?php } ?>
				
				<input type="radio" name="status[<?=$requirement["id"]?>]" value="<?=OK?>" <?=$OKChecked?><?=$readonly?> /> Ok
				<input type="radio" name="status[<?=$requirement["id"]?>]" value="<?=NC?>" <?=$NCChecked?><?=$readonly?> /> NC
				<input type="radio" name="status[<?=$requirement["id"]?>]" value="<?=NA?>" <?=$NAChecked?><?=$readonly?> /> NA
				<!-- <input type="checkbox" name="isCritical[<?=$requirement["id"]?>]" value="<?=$requirement["id"]?>" <?=$CriticalChecked?><?=$readonly?> />Cr&iacute;tico -->
				<input type="checkbox" name="sol[<?=$requirement["id"]?>]" value="<?=$requirement["id"]?>" <?=$solChecked?><?=$readonly?> />Solucionado?
				<span style="font-size:10px; font-weight:bold;"><?=$okChecked;?>
				<?=$naChecked;?>
				<?=$ncChecked;?>
				<?=$criticalChecked;?></span>
			</p>
			<p class="separator"></p>
			<?php $TOTAL++;?>
		<?php endforeach; ?>
		<p><?php // print $Cumplen." - Cumplen"; ?></p>
		<p><?php // print $Nocumplen." - No Cumplen"; ?></p>
		<p><?php // print $na." - No aplican"; ?></p>
		<p><?php // print $nd." - No definidos"; ?></p>
		<p><?php // print $Cumplen +$Nocumplen ." - SubTotal"; ?></p>
		<p><?php // print $TOTAL." - TOTAL"; ?></p>



		<div class="block-actions">
		<?php
		if( $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == SA ){
      if ($auditInstance["plannedDate"] != null && $auditInstance["reportedDate"] == null) { ?>
        <p class="buttons">
          <input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
        </p>
      <?php } ?>
    <?php } ?>
    
    <?php if ($_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == SA ){?>
			<?php if ($auditInstance["reportedDate"] == null) { ?>
			<p class="buttons">
				<input type="button" value="Cerrar Auditoria" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/closereportform/<?=$auditInstance["id"]?>');" />
			</p>
			<?php } ?>
		<?php } ?>
		<?php if ($_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == SA ){?>
			<?php if ($auditInstance["reportedDate"] == null) { ?>
			<p class="buttons">
				<input type="button" value="Notificar Reporte Completado" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/notifyreport/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>&n=notify');" />
			</p>
			<?php } ?>
		<?php } ?>
		<?php if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN){?>
			<?php if ($auditInstance["reportedDate"] != null) { ?>
			<p class="buttons">
				<input type="button" value="Reabrir Reporte" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/openreportconfirmation/<?=$auditInstance["id"]?>');" />
			</p>
			<?php } ?>
		<?php } ?>
	  </div>
		</div>
		</form>
	</div>

	<div id="right50">
		<form enctype="multipart/form-data" action="<?=SITE_URL?>audit/rupload/<?=$auditInstance["id"]?>" method="POST">
			<div style="margin-left:50px;">
				<strong>Archivos Anexos:</strong>
				<ul id="archivos">
					<?php if(!empty($archives)){
						foreach($archives as $archive){
							?>
							<li>
								<a href="../../archivos/<?=$archive['id']?>.<?=$archive['extension']?>"><?=$archive['nombre']?></a>&nbsp;
								<?php if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>
								<a href="<?=SITE_URL?>audit/delupload/<?=$archive["id"]?>">X</a>
								<?php endif; ?>
							</li>
							<?php
						}
					} else {
						?><li>No hay archivos cargados</li><?php 
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
		<p>
<?php
	if(!empty($users)){
		echo "<strong>Usuarios</strong><br/>";
		echo "Se ha enviado una notificaci&oacute;n a los siguientes usuarios<br/>";
		foreach($users as $user):
			echo $user["username"]."<br/>";
		endforeach;
	}
?>
		</p>
	</div>
</div>

<?php 
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>