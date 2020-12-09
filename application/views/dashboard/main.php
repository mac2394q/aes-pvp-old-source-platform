<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
      <div class="buttons">
          <form action="<?=SITE_URL?>dashboard/main" method="POST" style="margin-bottom:5px; display: inline-block;">
            <label>Buscar por nombre empresa: 
            <input type="text" value="" class="inputbox" name="w" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btnalt">
            </label>
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
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
<?php 
	if(count($companies) > 0) {
	  foreach($companies as $company): 
?>
						<tr>
							<td><a href="<?=SITE_URL?>audit/main/<?=$company["id"]?>"><?=$company["code"]?></a></td>
							<td><?=$company["socialName"]?></td>
							<td><?=$company["sectorName"]?></td>
							<td><? if($company["certificate"] !== NULL) { ?>
                <div class="buttons">
                  <form action="<?=SITE_URL?>audit/viewcertified/<?=$company["id"]?>" method="post" style="text-align:right; margin-bottom:5px;">
                  <input type="submit" value="Ver Certificado" class="btnalt"> 
                  </form>
                </div>
                <?php 
} 
?>
							</td>
						</tr>
<?php 
		endforeach; 
	} else{
?>
						<tr>
							<td colspan="4">No han sido definidas compa&ntilde;&iacute;as para este usuario.</td>
						</tr>
<?php 
	}
?>	
					</tbody>
				</table>
			</div>
			
		</div>
		<!-- Alternative Content Box End -->
<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>
