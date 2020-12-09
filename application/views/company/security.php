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
				<form action="<?=SITE_URL?>company/savesecurity/<?=$company["id"]?>" method="post">
					<div>
						<p>
							<label for="securityMgmtName"><strong>Nombre:</strong></label>
							<input type="text" id="securityMgmtName" name="securityMgmtName" class="inputbox" value="<?=$company["securityMgmtName"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtCharge"><strong>Cargo:</strong></label>
							<input type="text" id="securityMgmtCharge" name="securityMgmtCharge" class="inputbox" value="<?=$company["securityMgmtCharge"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtEmail"><strong>Email:</strong></label>
							<input type="text" id="securityMgmtEmail" name="securityMgmtEmail" class="inputbox" value="<?=$company["securityMgmtEmail"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtPhone"><strong>Tel&eacute;fono:</strong></label>
							<input type="text" id="securityMgmtPhone" name="securityMgmtPhone" class="inputbox" value="<?=$company["securityMgmtPhone"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtMobile"><strong>Celular:</strong></label>
							<input type="text" id="securityMgmtMobile" name="securityMgmtMobile" class="inputbox" value="<?=$company["securityMgmtMobile"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtAddress"><strong>Direcci&oacute;n:</strong></label>
							<input type="text" id="securityMgmtAddress" name="securityMgmtAddress" class="inputbox" value="<?=$company["securityMgmtAddress"]?>" /> <br />
						</p>
						<p>
							<label for="securityMgmtCity"><strong>Ciudad:</strong></label>
							<input type="text" id="securityMgmtCity" name="securityMgmtCity" class="inputbox" value="<?=$company["securityMgmtCity"]?>" /> <br />
						</p>
					</div>
					<div style="clear:both;"></div>
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