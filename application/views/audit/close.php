<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Auditor&iacute;as Disponibles para Cerrar</h2>
			</div>
			<div class="contentbox">
				<table width="100%">
					<thead>
						<tr>
							<th>Proveedor</th>
							<th>Sede</th>
							<th>Fecha de Apertura</th>
							<th>Fecha de Cierre</th>
							<th>Estatus</th>
							<th>&iquest;Cerrar?</th>
						</tr>
					</thead>
					<tbody>
<?php 
	if(count($audits) > 0) {
		foreach($audits as $audit): 
?>
						<tr>
							<td><?=$audit["socialName"]?></td>
							<td><?=$audit["branchName"]?></td>
							<td><?=$audit["openingDate"]?></td>
							<td><?=$audit["closureDate"]?></td>
							<td><?=$audit["statusName"]?></td>
							<td>
								<form action="<?=SITE_URL?>audit/close/<?=$audit["auditInstance"]?>" method="post">
									<input type="submit" value="Cerrar" class="btnalt">
								</form>
							</td>
						</tr>
<?php 
		endforeach; 
	} else{
?>
						<tr>
							<td colspan="4">No hay auditor&iacute;as esperando ser aceptadas.</td>
						</tr>
<?php 
	}
?>	
					</tbody>
				</table>
			</div>
		</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>