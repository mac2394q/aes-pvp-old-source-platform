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
				<table width="100%">
					<thead>
						<tr>
							<th><?=LBL_CUSTOMER?></th>
							<th><?=LBL_SECTOR?></th>
<?php
		if($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR ):
?>
							<th>Eliminar</th>
							<th></th>
<?php
		endif;
?>
						</tr>
					</thead>
					<tbody>
<?php 
		if (count($companies) > 0) {
			foreach($companies as $companie):
?>
						<tr>
							<td><a href="<?=SITE_URL?>company/main/<?=$companie["id"]?>"><?=$companie["socialName"]?></a></td>
							<td><?=$companie["sectorName"]?></td>
<?php
		if($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR ):
?>
							<form action="<?=SITE_URL?>company/customers/<?=$company["id"]?>" method="post" style="text-align:center;">
								<td><input name="delete[]" type="checkbox" value="<?=$companie["id"]?>"></td>
								<td>
									<input type="submit" value="Eliminar" class="btnalt">
								</td>
							</form>
<?php
		endif;
?>
						</tr>
<?php 
			endforeach; 
		} else {
?>	
						<tr>
							<td colspan="3">No existen clientes asociados para <?=$company["socialName"]?></td>
						</tr>
<?php 
		} 
?>	
					</tbody>
				</table>
				<p class="search">
					<form action="<?=SITE_URL?>company/customers/<?=$company["id"]?>" method="post" style="text-align:center;">
						<label for="search"><strong>Buscar Clientes para Agregar</strong></label>
						<input type="text" id="search" name="search" class="inputbox" value="<?=isset($search) ? $search: "";?>"> 
						<input type="submit" value="Buscar" class="btnalt">
					</form>
				</p>
<?php 
		if (isset($companiesSearched) && count($companiesSearched) > 0) {
?>
				<table width="100%">
					<thead>
						<tr>
							<th><?=LBL_CUSTOMER?></th>
							<th><?=LBL_SECTOR?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
<?php 
			foreach($companiesSearched as $companie):
?>
						<tr>
							<td><a href="<?=SITE_URL?>company/main/<?=$companie["id"]?>"><?=$companie["socialName"]?></a></td>
							<td><?=$companie["sectorName"]?></td>
							<td>
								<form action="<?=SITE_URL?>company/customers/<?=$company["id"]?>" method="post">
									<input type="hidden" name="search" value="<?=isset($search) ? $search: "";?>">
									<input type="hidden" name="customer" value="<?=$companie["id"]?>">
									<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>
									<input type="submit" value="Agregar" class="btnalt">
									<? endif;?>
								</form>
							</td>
						</tr>
<?php 
			endforeach; 
?>	
					</tbody>
				</table>
<?php 
		} 
?>	
			</div>
		</div>
		<!-- Graphs Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>