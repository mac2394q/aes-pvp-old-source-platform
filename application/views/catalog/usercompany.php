<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
			<div class="headings altheading">
				<h2 class="left"><?=LBL_HEADER?> - <?=$user["username"]?></h2>
				<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top"><a href="<?=SITE_URL?>catalog/edituser/<?=$user['id']?>">Informaci&oacute;n General</a></li>
					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="<?=SITE_URL?>catalog/usercompany/<?=$user['id']?>">Empresas</a></li>
				</ul>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
				<form action="<?=SITE_URL?>catalog/saveusercompany/<?=$user["id"]?>" method="post">
					<div class="leftcol">
						<p>
							<label for="company"><strong>Empresas Disponibles:</strong></label>
							<select id="company" name="company" class="boxsize" onchange="getBranches(this.value);">
<?php 
		foreach($companies as $companie): 
			if($companie['id'] == $company['id']) {
?>
								<option selected="selected" value="<?=$companie['id']?>"><?=$companie['socialName']?></option>
<?php
			} else {
				if($user["role"] != SA && $user["role"] != ADMIN && $user["role"] != COORDINADOR) {
?>
								<option value="<?=$companie['id']?>"><?=$companie['socialName']?></option>
<?php
				}
			} 
		endforeach;
?>
							</select><br />
						</p>
						<p>
<?php 
		foreach($companybranches as $branch): 
			if(in_multi_array($branch['id'], 'id', $userbranches)){
				$checked = " checked='checked'";
			} else {
				$checked = "";
			}
?>
							<input type="checkbox" name="branch[]" value="<?=$branch['id']?>"<?=$checked?> /><?=$branch['name']?><br />
<?php
		endforeach;
?>
						</p>
					</div>
					<div class="rightcol">
						<p>
							<strong>Empresas Permitidas:</strong><br />
<?php
		if(count($userbranches) >= 0) {
			$currentCompany = 0;
			
			foreach($userbranches as $branch):
				if($branch['company'] != $currentCompany) {
?>
							+ <?=$branch['socialName']?><br />
<?php 				
					$currentCompany = $branch['company'];
				}
?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <?=$branch['name']?><br />
<?php
			endforeach;
		} else {
?>
							Ninguna
<?php 
		}
?>
						</p>						
					</div>
					<div class="break"></div>
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
		
		function in_multi_array($needle, $field, $haystack) {
			foreach ($haystack as $hay) {
				if ($hay[$field] == $needle) return true;
			}
			
			return false;
		}
?>
<script type="text/javascript">
	function getBranches(company) {
		location.replace('<?=SITE_URL?>catalog/usercompany/<?=$user['id']?>?company=' + company);
	}
</script>