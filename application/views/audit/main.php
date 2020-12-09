<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		 <div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
<?php
			include_once('tabs.php');
?>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
				<form action="<?=SITE_URL?>audit/main/<?=$company["id"]?>" method="post">
					<table width="100%">
						<thead>
							<tr>
								<th width="10"></th>
								<th>Sede</th>
								<th>Status</th>
<?php
			if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == CLIENTE || $_SESSION["user"]["role"] == COORDINADOR){
?>
								<th>Editar status</th>
<?php
			}
?>
								<th>Empresa</th>
							</tr>
						</thead>
						<tbody>
<?php 
		$i = 1;
		foreach($branches as $branche): 
			if(isset($_SESSION["branch"])){
				$selected = ($_SESSION["branch"] == $branche["branch"]) ? "checked" : "";
			}else{
				$selected = "";
			}
?>
							<tr>
								<td><input type="radio" name="branch" value="<?=$branche["branch"]?>" <?=$selected ?> onclick="submit();"></td>
								<td><?=$branche["branchName"]?></td>
								<td><?=$branche["statusName"]?></td>
<?php
			if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == CLIENTE || $_SESSION["user"]["role"] == COORDINADOR){
?>
								<td>
									<select name="branchs[<?=$branche["branch"]?>]">
										<option value="">Seleccionar</option>
										<option value="4">Aprobado</option>
										<option value="5">Reprobado</option>
									<select/>
									<input type="submit" value="Cambiar" class="btnalt"/>
								</td>
<?php
			}
?>
								<td><?=$branche["socialName"]?></td>
							</tr>
<?php 
		$i++;
		endforeach; 
?>
						</tbody>
					</table>
				</form>
			</div>
			
		</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>