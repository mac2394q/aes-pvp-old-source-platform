<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Clonaci&oacute;n de Plantilla de Auditor&iacute;a</h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>templates/clonar_save" method="post">
					T&iacute;tulo de Plantilla:<br />
					<input type="text" name="titulo" class="inputbox"><br /><br />
					<table width="100%">
						<thead>
							<tr>
								<th></th>
								<th>N&uacute;mero</th>
								<th>Nombre</th>
								<th>Descripci&oacute;n</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
<?php 
	if(count($template) > 0) {
		foreach($template as $requirement): 
?>
							<tr>
								<td></td>
								<td>
									<input type="hidden" name="id[]" value="<?=$requirement["id"]?>">
									<input type="hidden" name="order[<?=$requirement["id"]?>]" value="<?=$requirement["order"]?>">
									<input type="text" name="number[<?=$requirement["id"]?>]" value="<?=$requirement["number"]?>" class="inputbox tinybox" maxlength="4">
								</td>
								<td><input type="text" name="name[<?=$requirement["id"]?>]" value="<?=$requirement["name"]?>" class="inputbox"></td>
								<td><textarea name="description[<?=$requirement["id"]?>]" class="inputarea regulararea"><?=$requirement["description"]?></textarea></td>
								<td>
									<img class="up" style="cursor:pointer;" src="<?=SITE_URL?><?=IMG_LOCATION?>up.png" />&nbsp;
									<img class="down" style="cursor:pointer;" src="<?=SITE_URL?><?=IMG_LOCATION?>dn.png" />
								</td>
							</tr>
<?php 
		endforeach; 
	}
?>
						</tbody>
					</table>
					<br />
					<p class="buttons">
						<input type="submit" value="Guardar" class="btnalt">
						<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>templates/main');">
					</p>
				</form>
			</div>
		</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>