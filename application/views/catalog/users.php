<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
		 <p class="buttons">
		     <form action="<?=SITE_URL?>catalog/users" method="POST" style="margin-bottom:5px; display: inline-block;">
            <label>Buscar por nombre:
            <input type="text" value="" class="inputbox" name="w" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btnalt">
            </label>
          </form>
          <form action="<?=SITE_URL?>catalog/adduser" method="post" style="margin-bottom:5px; display: inline-block;">
            <input type="submit" value="<?=LBL_ADD?>" class="btnalt">
          </form>
      </p>
			<div class="headings altheading">
				<h2><?=LBL_HEADER?></h2>
			</div>
			<div class="contentbox">
				<table width="100%">
					<thead>
						<tr>
							<th>Nombre de Usuario</th>
							<th>Nombre Real</th>
							<th><?=LBL_ROLE_NAME?></th>
							<th>Borrar</th>
						</tr>
					</thead>
					<tbody>
<?php 
		foreach($users as $user): 
			if($user["roleId"] != SA) {
?>
						<tr>
							<td><a href="<?=SITE_URL?>catalog/edituser/<?=$user["id"]?>"><?=$user["username"]?></a></td>
							<td><?=$user["fullname"]?></a></td>
							<td><?=$user["roleName"]?></a></td>
							<td><a href="javascript:if(confirm('&iquest;Realmente desea eliminar el usuario <?=$user["fullname"]?>?')){location.replace('<?=SITE_URL?>catalog/deleteuser/<?=$user["id"]?>');}"><img src="<?=SITE_URL?><?=IMG_LOCATION?>delete.png" /></a></td>
						</tr>
<?php 
			}
		endforeach; 
?>	
					</tbody>
				</table>
				<p class="buttons">
					<form action="<?=SITE_URL?>catalog/adduser" method="post" style="text-align:center;">
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