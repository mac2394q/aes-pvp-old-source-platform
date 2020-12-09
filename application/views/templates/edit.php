<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Plantilla de Auditor&iacute;a para Sector: <?=$sector['name']?></h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>templates/save/<?=$sector['id']?>" method="post">
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
								<td><img class="deletereq" style="cursor:pointer;" src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></td>
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
							<tr>
								<td></td>
								<td>
									<input type="hidden" name="id[]" value="0">
									<input type="hidden" name="order[0]" value="">
									<input type="text" name="number[0]" value="" class="inputbox tinybox">
								</td>
								<td><input type="text" name="name[0]" value="" class="inputbox"></td>
								<td class="minifont"><textarea name="description[0]" class="inputarea regulararea"></textarea><br>Este requerimiento ser&aacute; agregado al presionar < Guardar > solo si es capturado</td>
								<td></td>
							</tr>
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