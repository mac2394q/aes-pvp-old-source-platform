<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Plantillas</h2>
			</div>
		   <div class="contentbox">
			<form action="<?=SITE_URL?>templates/clonar" method="POST">
		     <table width="100%">
		    <thead>
						<tr>
                        							<th>Sector</th>
							<th>Plantilla</th>
							<th>Requerimientos</th>
                            							<th>Selección</th>
                                                         <th>Borrar</th>
						</tr>
					</thead>
					<tbody>
<?php 
		foreach($templates as $template): 
?>
						<tr>
<?php
			if($template['requirementsQty'] != 0){ 
?>
							
                      <td><a href="<?=SITE_URL?>templates/edit/<?=$template["id"]?>"><?=$template["name"]?></a></td>
							<td>Disponible</td>
							<td><?=$template["requirementsQty"]?></td>
                            							<td><input type="checkbox" name="clonar[<?=$template["id"]?>]" /></td>
<?php
			} else { 
?>
							<td><a href="<?=SITE_URL?>templates/add/<?=$template["id"]?>"><?=$template["name"]?></a></td>
							<td>No Disponible</td>
							<td><?=$template["requirementsQty"]?></td>
                            							<td></td>
                                                                         <td><a href="javascript:if(confirm('&iquest;Realmente desea eliminar la plantilla <?=$template["name"]?>?')){location.replace('<?=SITE_URL?>templates/deletetemplate/<?=$template["id"]?>');}"><img src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></a></td>
<?php
			} 
?>
						</tr>
<?php 
		endforeach; 
?>	
					</tbody>
				</table>
				<div style="margin-top:30px; float:right;">
				<input type="submit" value="Clonar los seleccionados" class="btnalt">
			</div>
			</form>
		   </div>
			
		</div>
		<!-- Alternative Content Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>