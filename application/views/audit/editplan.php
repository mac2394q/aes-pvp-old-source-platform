<?php
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');	
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');?>
		<div class="contentcontainer">
			<div class="headings altheading">
				<h2>Plan de Auditor&iacute;a</h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>audit/saveplan/<?=$auditInstance['id']?>" method="post">
					<div class="leftcol">
						<p>
							<label for="textfield"><strong>Empresa</strong></label>							
							<input type="hidden" name="auditTemplate" value="<?=$branch['auditTemplate']?>">
							<input type="hidden" name="provider" value="<?=$branch['company']?>">
							<?=$branch['socialName']?>
						</p>
						<p>
							<label for="textfield"><strong>Sede</strong></label>
							<input type="hidden" name="branch" value="<?=$branch['id']?>">
							<?=$branch['name']?>
						</p>
						<p>
							<label for="textfield"><strong>Direcci&oacute;n de la Sede</strong></label>
							<?=$branch['postalAddress']?>, <?=$branch['city']?>,
						</p>
						<p>
							<label for="textfield"><strong>Representante Legal</strong></label>
							<?=$branch['legalRepresentative']?>
						</p>
						<p>
							<label for="textfield"><strong>Email</strong></label>
							<?=$branch['email']?>
						</p>
						<p>
						<?php
							if(!empty($users)){
								echo "<strong>Usuarios</strong><br/>";
								echo "Se ha enviado una notificación a los siguientes usuarios<br/>";
								foreach($users as $user):
									echo $user["username"]."<br/>";
								endforeach;	}
						?>
						</p>
						<p>
							<label for="textfield"><strong>Fecha de Registro</strong></label>
							<?=$auditInstance["cdate"]?> <br />
							<input type="hidden" name="cdate" value="<?=$auditInstance["cdate"]?>" />
						</p>
					</div>
					<div class="rightcol">
						<p>
							<label for="textfield"><strong>Alcance</strong></label>
							<?=$auditInstance["scope"]?>
 						</p>
						<p>
							<label for="textfield"><strong>Criterios</strong></label>
							<?=$auditInstance["criteria"]?>
 						</p>
						<p>
							<label for="textfield"><strong>Tipo de Auditor&iacute;a</strong></label>
							<?php
							foreach($types as $type):
								if($type['id'] == $auditInstance["type"]) {	?>
									<?=$type['name']?><?php
								}
							endforeach; ?>
						</p>
						<p>
							<label for="textfield"><strong>Fecha y Hora de Reuni&oacute;n de Apertura</strong></label>
							<?=$auditInstance["openingDate"]?>
 						</p>
						<p>
							<label for="textfield"><strong>Fecha y Hora de Reuni&oacute;n de Cierre</strong></label>
							<?=$auditInstance["closureDate"]?>
 						</p>
						<?php
							foreach($auditors as $auditor):
								if($auditor['id'] == $auditInstance["auditor"]) {
									$auditorName = $auditor['fullname'];?>
 						<p>
							<label for="textfield"><strong>Auditor L&iacute;der</strong></label>
							<?=$auditor['fullname']?>
						</p>
						<p>
							<label for="textfield"><strong>Email</strong></label>
							<?=$auditor['email']?>
						</p><?php
								}
							endforeach;
						?>
					</div>
					<div style="clear:both;"></div>
						<table width="100%">
							<thead>
								<tr>
									<th></th>
									<th>Auditor</th>
									<th>Fecha y Hora</th>
									<th>Elemento/Actividad por Auditar</th>
									<th>&nbsp;</th>
								</tr>
							</thead>
							<tbody><?php
								if(count($activities) > 0) {
									foreach($activities as $activity): ?>
								<tr>
									<?php if ($_SESSION['user']['role'] == AUDITOR) {?>
									<td><a href="javascript:if(confirm('&iquest;Realmente desea eleminar la actividad seleccionada?')){location.replace('<?=SITE_URL?>audit/deleteactivity/<?=$activity["id"]?>');}"><img src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></a></td>
									<?php } else{ ?>
									<td></td>
									<?php } ?>
									<td>
										<input type="hidden" name="id[]" value="<?=$activity["id"]?>">
										<input type="text" name="auditor[<?=$activity["id"]?>]" value="<?=$activity["auditor"]?>" class="inputbox mediumbox">
									</td>
									<td><input type="text" name="auditDate[<?=$activity["id"]?>]" value="<?=$activity["auditDate"]?>" class="inputdate"></td>
									<td><textarea name="description[<?=$activity["id"]?>]" class="inputarea regulararea"><?=$activity["description"]?></textarea></td>
									<td>&nbsp;</td>
								</tr><?php
									endforeach;
								}
								if ($auditInstance["plannedDate"] == null) {?>
								<tr>
									<td></td>
									<td>
										<input type="hidden" name="id[]" value="0">
										<input type="text" name="auditor[0]" value="<?=$auditorName?>" class="inputbox mediumbox">
									</td>
									<td><input type="text" name="auditDate[0]" value="" class="inputdate"></td>
									<td class="minifont"><textarea name="description[0]" class="inputarea regulararea"></textarea><br>Este elemento ser&aacute; agregado al presionar < Guardar > solo si es capturado</td>
									<td>&nbsp;</td>
								</tr><?php	} ?>
								<tr>
									<td>
									</td>
									<td>
									</td>
									<td>
									</td>
									<td>
										<label><strong>Notas</strong></label>
										<textarea name="notas" class="inputarea regulararea"><?=$auditInstance["notas"];?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						<?php if ($_SESSION["user"]["role"] != PROVEEDOR) {?>
						<p class="buttons">
							<input type="submit" value="Guardar" class="btnalt" />
						</p>
						<?php } ?>
				</form>
				<p class="buttons"><?php
				if ($auditInstance["plannedDate"] == null && $_SESSION['user']['role'] != PROVEEDOR) {?>
					<input type="submit" value="Marcar Completo" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/planready/<?=$auditInstance['id']?>?branch=<?=$branch['id']?>&e=<?=$branch['socialName']?>&s=<?=$branch['name']?>');" />
				<?php } ?>
					<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/plans');" />
				</p>
			</div>
		</div><?php
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');?>
<script>
	$(function() {
		$(".inputdate").datetimepicker({
			dateFormat:'yy-mm-dd', timeFormat:'hh:mm', hour:9, minute:0, timeText:'Elecci&oacute;n:', hourText:'Hora', minuteText:'Minuto', currentText:'Ahora', closeText:'Listo'
		});
	});
</script>











