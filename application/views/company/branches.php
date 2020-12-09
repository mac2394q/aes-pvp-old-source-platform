<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'messages.php');
?>
		 <!-- Graphs Box Start -->
		<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
<?php
			include_once('tabs.php');
?>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
				<form action="<?=SITE_URL?>company/branches/<?=$company["id"]?>" method="post">
					<table width="100%">
						<thead>
							<tr>
								<th>Sede</th>
								<th># Empleados</th>
								<th>&iquest;Es Principal?</th>
							</tr>
						</thead>
						<tbody>
<?php 
		foreach($branches as $branch):
			if($branch["main"]) {
				$checked = ' checked="checked"';
			} else {
				$checked = '';
			}
?>
							<tr>
								<td>
									<input type="hidden" name="id[]" value="<?=$branch["id"]?>" />
									<input type="text" name="name[<?=$branch["id"]?>]" value="<?=$branch["name"]?>" class="inputbox" />
								</td>
								<td><input type="text" name="workers<?=$branch["id"]?>" value="<?=$branch["workers"]?>" style="width:100px;" class="inputbox" /></td>
								<td><input type="radio" name="main" value="<?=$branch["id"]?>" <?=$checked?>></td>
							</tr>
<?php 
		endforeach;

		if(count($branches) == 0) {
			$checked = ' checked="checked"';
		} else {
			$checked = '';
		}
?>	
							<tr>
								<td class="minifont">
									<input type="hidden" name="id[]" value="0" />
									<input type="text" name="name[0]" value="" class="inputbox" /><br />Esta sede ser&aacute; agregada al presionar < Guardar > solo si es capturada
								</td>
								<td><input type="text" name="workers" value="" style="width:100px;" class="inputbox" /></td>
								<td><input type="radio" name="main" value="0" <?=$checked?>/></td>
							</tr>
						</tbody>
					</table>
					<div style="clear:both;"></div>
					<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>
					<p class="buttons">
						<input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
					</p>
					<? endif; ?>
				</form>
			</div>
		</div>
		<!-- Graphs Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>