<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
			<div class="headings altheading">
				<h2 class="left"><?=LBL_HEADER?> - <?php echo $user["id"] == 0? "Nuevo": $user["username"]; ?></h2>
				<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="<?=SITE_URL?>catalog/edituser/<?=$user['id']?>">Informaci&oacute;n General</a></li>
					<li class="ui-state-default ui-corner-top"><a href="<?=SITE_URL?>catalog/usercompany/<?=$user['id']?>">Empresas</a></li>
				</ul>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
				<form action="<?=SITE_URL?>catalog/saveuser/<?=$user["id"]?>" method="post">
					<p>
						<label for="username"><strong>Usuario:</strong></label>
						<input type="text" id="username" name="username" class="inputbox" value="<?=$user["username"]?>"> <br />
					</p>
					<p>
						<label for="password"><strong>Contrase&ntilde;a:</strong></label>
						<input type="password" id="password" name="password" class="inputbox" value=""><br />
						<span class="red">* Para un usuario nuevo deje el campo vacio para que el sistema asigne una clave</span><br/>
						<span class="red">* Solo proporcione la contrase&ntilde;a si desea sobreescribirla.</span>
					</p>					
					<p>
						<label for="fullname"><strong>Nombre:</strong></label>
						<input type="text" id="fullname" name="fullname" class="inputbox" value="<?=$user["fullname"]?>"> <br />
					</p>
					<p>
						<label for="email"><strong>Email:</strong></label>
						<input type="text" id="email" name="email" class="inputbox" value="<?=$user["email"]?>"> <br />
					</p>
					<p>
						<label for="role"><strong>Rol:</strong></label>
						<select id="role" name="role" class="boxsize">
<?php 
		if($user['id'] == 0){
?>
							<option selected="selected" value="">Seleccione...</option>
<?php			
		}
		
		foreach($roles as $role): 
			if($user["role"] == $role['id']) {
?>
							<option selected="selected" value="<?=$role['id']?>"><?=$role['name']?></option>
<?php
			} else { 
				if($user["role"] != SA) {
?>
							<option value="<?=$role['id']?>"><?=$role['name']?></option>
<?php
				}
			} 
		endforeach;
?>
						</select><br />
					</p>
					<p>
						<label for="company"><strong>Empresa:</strong></label>
						<select id="company" name="company" class="boxsize">
<?php 
		if($user['id'] == 0){
?>
							<option selected="selected" value="0">Seleccione...</option>
<?php			
		}
		
		foreach($companies as $company): 
			if($user["company"] == $company['id']) {
?>
							<option selected="selected" value="<?=$company['id']?>"><?=$company['socialName']?></option>
<?php
			} else { 
				if($user["role"] != SA && $user["role"] != ADMIN && $user["role"] != AUDITOR && $user["role"] != COORDINADOR) {
?>
							<option value="<?=$company['id']?>"><?=$company['socialName']?></option>
<?php
				}
			} 
		endforeach;
?>
						</select><br />
					</p>
					
					<p class="buttons">
						<input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
						<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>catalog/users');">
					</p>
				</form>
			</div>
			
		</div>
		<!-- Alternative Content Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>