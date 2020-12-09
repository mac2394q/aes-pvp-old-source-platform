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
				<form action="<?=SITE_URL?>company/savegeneral/<?=$company["id"]?>" method="post" enctype="multipart/form-data">
					<div class="leftcol">
							<input type="hidden" name="aes" value="<?=$company["aes"]?>">
							<!--<label for="socialName"><strong>N&uacute;mero de Cuenta</strong></label>-->
							<!--<input type="text" id="accountNumber" name="accountNumber" class="inputbox" value="<?=$company["accountNumber"]?>"> <br />-->
					 <p>
							<label for="code"><strong><?=LBL_CODE?></strong></label>
							<input type="text" id="code" name="code" class="inputbox" value="<?=$company["code"]?>" readonly> <br />
					</p>
						<p>
							<label for="socialName"><strong><?=LBL_SOCIAL_NAME?></strong></label>
							<input type="text" id="socialName" name="socialName" class="inputbox" value="<?=$company["socialName"]?>"> <br />
						</p>
						<p>
							<label for="postalAddress"><strong><?=LBL_POSTAL_ADDRESS?></strong></label>
							<input type="text" id="postalAddress" name="postalAddress" class="inputbox" value="<?=$company["postalAddress"]?>"> <br />
						</p>
						<p>
							<label for="city"><strong><?=LBL_CITY?></strong></label>
							<input type="text" id="city" name="city" class="inputbox" value="<?=$company["city"]?>"> <br />
						</p>
						<p>
							<label for="country"><strong><?=LBL_COUNTRY?></strong></label>
							<select id="country" name="country" class="boxsize">
<?php
	if ($company['country'] == null || $company['country'] == 0){ 
?>
								<option selected="selected" value="">Seleccione...</option>
<?php 
	}
	
	foreach($countrys as $country):
		$selected = $country['id'] == $company['country'] ? " selected='selected'" : $selected = "";	
?> 
								<option value="<?=$country['id']?>" <?=$selected?>><?=$country['nombre']?></option>
<?php
	endforeach; 
?>
							</select><br />
						</p>
						<p>
							<label for="sector"><strong><?=LBL_SECTOR?></strong></label>
							<select id="sector" name="sector" class="boxsize">
<?php
	if ($company['sector'] == null || $company['sector'] == 0){ 
?>
								<option selected="selected" value="">Seleccione...</option>
<?php 
	}
	
	foreach($sectors as $sector):
		$selected = $sector['id'] == $company['sector'] ? " selected='selected'" : $selected = "";	
?> 
								<option value="<?=$sector['id']?>" <?=$selected?>><?=$sector['name']?></option>
<?php
	endforeach; 
?>
							</select><br />
						</p>
					</div>
					<div class="rightcol">
						<p>
							<label for="legalRepresentative"><strong><?=LBL_LEGAL_REPRESENTATIVE?></strong></label>
							<input type="text" id="legalRepresentative" name="legalRepresentative" class="inputbox" value="<?=$company["legalRepresentative"]?>"> <br />
						</p>
						<p>
							<label for="carge"><strong><?=LBL_CARGE?></strong></label>
							<input type="text" id="carge" name="carge" class="inputbox" value="<?=$company["carge"]?>"> <br />
						</p>
						<p>
							<label for="phoneFax"><strong><?=LBL_PHONE_FAX?></strong></label>
							<input type="text" id="phoneFax" name="phoneFax" class="inputbox" value="<?=$company["phoneFax"]?>"> <br />
						</p>
						<p>
							<label for="webAddress"><strong><?=LBL_WEB_ADDRESS?></strong></label>
							<input type="text" id="webAddress" name="webAddress" class="inputbox" value="<?=$company["webAddress"]?>"> <br />
						</p>
						<p>
							<label for="email"><strong><?=LBL_EMAIL?></strong></label>
							<input type="text" id="email" name="email" class="inputbox" value="<?=$company["email"]?>"> <br />
						</p>
						<p>
							<label for="nit"><strong><?=LBL_NIT?></strong></label>
							<input type="text" id="nit" name="nit" class="inputbox" value="<?=$company["nit"]?>"> <br />
						</p>
					</div>
					<div style="clear:both;">
					<?php if( $company["id"] != 0 ){ ?>  
					  <label for="nit"><strong>Subir Certificado:</strong></label>
					  <input type="file" name="certificate" class="inputbox" />
					<?php } ?> 
					</div>
					<? if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == COORDINADOR): ?>
					<p class="buttons">
						<input type="submit" value="<?=LBL_SAVE?>" class="btnalt">
					</p>
					<? endif; ?>
				</form>
			</div>
		</div>
		<!-- Graphs Box End -->
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>