<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
		  <div class="buttons">
		      <form action="<?=SITE_URL?>catalog/companies" method="POST" style="margin-bottom:5px; display: inline-block;">
		        <label>Buscar por nombre:
            <input type="text" value="" class="inputbox" name="w" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btnalt">
            </label>
          </form>
          <form action="<?=SITE_URL?>company/main/0" method="post" style="margin-bottom:5px; display: inline-block;">
            <input type="submit" value="<?=LBL_ADD?>" class="btnalt">
          </form>
      </div>
			<div class="headings altheading">
				<h2><?=LBL_HEADER?></h2>
			</div>
			<div class="contentbox">
				<table width="100%">
					<thead>
						<tr>
							<th><?=LBL_ACCOUNT_NUMBER?></th>
							<th><?=LBL_COMPANY_NAME?></th>
							<th><?=LBL_SECTOR?></th>
							<th>Borrar</th>
						</tr>
					</thead>
					<tbody>
<?php 
		foreach($companies as $company):
?>
						<tr>
							<td><a href="<?=SITE_URL?>company/main/<?=$company["id"]?>"><?=$company["code"]?></a></td>
							<td><?=$company["socialName"]?></td>
							<td><?=$company["sectorName"]?></td>
							<td><a href="javascript:if(confirm('&iquest;Realmente desea eliminar la empresa <?=$company["socialName"]?>?')){location.replace('<?=SITE_URL?>catalog/deletecompanies/<?=$company["id"]?>');}"><img src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></a></td>
						</tr>
<?php 
		endforeach; 
?>	
					</tbody>
				</table>
				<p class="buttons">
					<form action="<?=SITE_URL?>company/main/0" method="post" style="text-align:center;">
						<input type="submit" value="<?=LBL_ADD?>" class="btnalt">
					</form>
				</p>
			</div>
			
		</div>
		<!-- Alternative Content Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>