<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Coordinar Auditor&iacute;as</h2>
			</div>
			<div class="contentbox">
				<div class="filter">
					<form action="<?=SITE_URL?>audit/listall" method="post">
						<strong>Proveedor:&nbsp;</strong>
						<select id="filter" name="filter" class="boxsize" onchange="submit();">
							<option selected="selected" value="0">Seleccione...</option>
<?php 
	foreach($providers as $prov):
		$selected = $prov['id'] == $provider ? " selected='selected'" : $selected = "";	
		
		if (!$prov['aes']) {
?> 
							<option value="<?=$prov['id']?>" <?=$selected?>><?=$prov['socialName']?></option>
<?php
		}
	endforeach; 
?>
						</select>
					</form>	
				</div>
				<table width="100%">
					<thead>
						<tr>
							<th>Sede</th>
							<th>&Uacute;ltima Auditor&iacute;a</th>
							<th>Estatus</th>
							<th>Empresa</th>
						</tr>
					</thead>
					<tbody>
<?php 
	if(count($audits) > 0) {
		foreach($audits as $audit): 
			if($audit["auditInstance"] != null) {
?>
						<tr>
							<td><a href="<?=SITE_URL?>audit/editinstance/<?=$audit["auditInstance"]?>"><?=$audit["branchName"]?></a></td>
							<td><?=$audit["cdate"]?></td>
							<td><?=$audit["statusName"]?></td>
							<td><?=$audit["socialName"]?></td>
						</tr>
<?php 
			} else {
?>
						<tr>
							<td><a href="<?=SITE_URL?>audit/createinstance/<?=$audit["branch"]?>"><?=$audit["branchName"]?></a></td>
							<td>ND</td>
							<td>ND</td>
							<td>ND</td>
						</tr>
<?php 				
			}
		endforeach; 
	} else{
?>
						<tr>
							<td colspan="4">No hay sedes definidas para esta empresa.</td>
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