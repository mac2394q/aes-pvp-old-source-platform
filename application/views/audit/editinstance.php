<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Auditor&iacute;a</h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>audit/saveinstance/<?=$auditInstance["id"]?>" method="post">
					<div class="leftcol">
						<p>
							<label for="textfield"><strong>Empresa</strong></label>
							<input type="hidden" name="auditTemplate" value="<?=$branch['auditTemplate']?>">
							<input type="hidden" name="provider" value="<?=$branch['company']?>">
							<input type="hidden" name="empresa" value="<?=$branch['socialName']?>">
							<?=$branch['socialName']?>
						</p>
						<p>
							<label for="textfield"><strong>Sede</strong></label>
							<input type="hidden" name="branch" value="<?=$branch['id']?>">
							<input type="hidden" name="sede" value="<?=$branch['name']?>">
							<?=$branch['name']?>
						</p>
						<p>
							<label for="textfield"><strong>Auditor</strong></label>
							<select id="auditor" name="auditor" class="boxsize">
<?php
	if($auditInstance["auditor"] == 0){
?>
								<option selected="selected" value="0">Seleccione...</option>
<?php 
	}
	
	foreach($auditors as $auditor):
		$selected = $auditor['id'] == $auditInstance["auditor"] ? " selected='selected'" : $selected = "";	
?> 
								<option value="<?=$auditor['id']?>" <?=$selected?>><?=$auditor['fullname']?></option>
<?php
	endforeach; 
?>
							</select>
						</p>
						<p>
							<label for="textfield"><strong>Fecha de Registro</strong></label>
							<?=$auditInstance["cdate"]?> <br /> 
							<input type="hidden" name="cdate" value="<?=$auditInstance["cdate"]?>" />
						</p>
						<p>
							<label for="textfield"><strong>Fecha y Hora de Reuni&oacute;n de Apertura</strong></label>
							<input type="text" id="openingDate" name="openingDate" class="inputbox" value="<?=$auditInstance["openingDate"]?>"><br /> 
						</p>
						<p>
							<label for="textfield"><strong>Fecha y Hora de Reuni&oacute;n de Cierre</strong></label>
							<input type="text" id="closureDate" name="closureDate" class="inputbox" value="<?=$auditInstance["closureDate"]?>"><br /> 
						</p>
<?php /*						
						<p>
							<label for="textfield"><strong>Fecha de otorgamiento (si es aplicable):</strong></label>
							<input type="text" id="grantDate" name="grantDate" class="inputbox" value="<?=$auditInstance["grantDate"]?>"><br /> 
						</p>
						<p>
							<label for="textfield"><strong>Fecha �ltima renovaci�n (si es aplicable):</strong></label>
							<input type="text" id="renewalDate" name="renewalDate" class="inputbox" value="<?=$auditInstance["renewalDate"]?>"><br /> 
						</p>
						<p>
							<label for="textfield"><strong>Fecha de Vencimiento (si es aplicable):</strong></label>
							<input type="text" id="maturityDate" name="maturityDate" class="inputbox" value="<?=$auditInstance["maturityDate"]?>"><br /> 
						</p>
 *
 */?>
            <p>
              <label for="textfield"><strong>Alcance</strong></label>
              <textarea name="scope" class="inputarea regulararea"><?=$auditInstance["scope"]?></textarea> 
            </p>
            <p>
              <label for="textfield"><strong>Criterios</strong></label>
              <textarea name="criteria" class="inputarea regulararea"><?=$auditInstance["criteria"]?></textarea> 
            </p>
            <p>
              <label for="textfield"><strong>Tipo</strong></label>
              <select id="type" name="type" class="boxsize">
<?php
  if($auditInstance["type"] == 0){ 
?>
                <option selected="selected" value="0">Seleccione...</option>
<?php 
  }
  
  foreach($types as $type):
    $selected = $type['id'] == $auditInstance["type"] ? " selected='selected'" : $selected = "";  
?> 
                <option value="<?=$type['id']?>" <?=$selected?>><?=$type['name']?></option>
<?php
  endforeach; 
?>
              </select>
            </p>
            <p>
              <label for="textfield"><strong>Estatus</strong></label>
              <select id="status" name="status" class="boxsize">
<?php
  if($auditInstance["status"] == 0){ 
?>
                <option selected="selected" value="0">Seleccione...</option>
<?php 
  }
  
  foreach($statuss as $status):
    $selected = $status['id'] == $auditInstance["status"] ? " selected='selected'" : $selected = "";  
?> 
                <option value="<?=$status['id']?>" <?=$selected?>><?=$status['name']?></option>
<?php
  endforeach; 
?>
              </select>
            </p>
            <p>
              <label for="textfield"><strong>Objetivos de la Auditor&iacute;a</strong></label>
              <textarea name="auditObjectives" class="inputarea regulararea"><?=$auditInstance["auditObjectives"]?></textarea> 
            </p>
            <p>
<?php
  if(!empty($users)){
    echo "<strong>Usuarios</strong><br/>";
    echo "Se ha enviado una notificacion a los siguientes usuarios<br/>";
    foreach($users as $user):
      echo $user["username"]."<br/>";
    endforeach;
  }
?>
            </p>
            
					</div>
					<div class="rightcol">
					</div>
					<div style="clear:both;"></div>
					<p class="buttons">
<?php
	if ($branch['auditTemplate'] != null) { 
?>
						<input type="submit" value="Guardar" class="btnalt">
<?php
	} 
?>
						<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/listall/0?filter=<?=$branch['company']?>');">
					</p>
                            </form>
			</div>
		</div>

<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>
<script>
	$(function() {
		$("#openingDate").datetimepicker({dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'});
		$("#closureDate").datetimepicker({dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'});
		$("#grantDate").datetimepicker({dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'});
		$("#renewalDate").datetimepicker({dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'});
		$("#maturityDate").datetimepicker({dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'});
	});
</script>