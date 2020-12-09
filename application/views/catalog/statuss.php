<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
		 <div class="buttons">
          <form action="<?=SITE_URL?>catalog/addstatus" method="post" style="text-align:right; margin-bottom: 5px;">
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
							<th style="width:20px;"></th>
							<th><?=LBL_STATUS_NAME?></th>
						</tr>
					</thead>
					<tbody>
<?php 
		foreach($statuss as $status): 
?>
						<tr>
							<td><a href="javascript:if(confirm('&iquest;Realmente desea eleminar el estatus -<?=$status["name"]?>-?')){location.replace('<?=SITE_URL?>catalog/deletestatus/<?=$status["id"]?>');}"><img src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></a></td>
							<td><a href="<?=SITE_URL?>catalog/editstatus/<?=$status["id"]?>"><?=$status["name"]?></a></td>
						</tr>
<?php 
		endforeach; 
?>	
					</tbody>
				</table>
				<p class="buttons">
					<form action="<?=SITE_URL?>catalog/addstatus" method="post" style="text-align:center;">
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