<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'messages.php');
?>
		<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
<?php
			include_once('tabs.php');
?>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom">
				<form action="<?=SITE_URL?>company/savecontact/<?=$company["id"]?>" method="post">
					<div>
						<div>
							<div style="float:left;">
								<p>
									<label for="invoiceToAddress"><strong>Enviar Factura a:</strong></label>
									<input type="text" id="invoiceToAddress" name="invoiceToAddress" class="inputbox" value="<?=$company["invoiceToAddress"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="invoiceToCity"><strong>Ciudad:</strong></label>
									<input type="text" id="invoiceToCity" name="invoiceToCity" class="inputbox" value="<?=$company["invoiceToCity"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
						<p>
							<label for="invoiceDueDate"><strong>Fecha de Corte:</strong></label>
							<input type="text" id="invoiceDueDate" name="invoiceDueDate" class="inputbox" value="<?=$company["invoiceDueDate"]?>" /> <br />
						</p>
						<p>
							<label for="taxpayerType"><strong>Tipo de Contribuyente:</strong></label>
							<input type="text" id="taxpayerType" name="taxpayerType" class="inputbox" value="<?=$company["taxpayerType"]?>" /> <br />
						</p>
						
						<p>
							<label for="icaRetainer"><strong>Retenedor de ICA:</strong></label>
							<input type="text" id="icaRetainer" name="icaRetainer" class="inputbox" value="<?=$company["icaRetainer"]?>" /> <br />
						</p>

					</div>
					<div style="clear:both;"></div>
					<div>
						<div>
							<div style="float:left;">
								<p>
									<label for="accountingName"><strong>Contacto Contabilidad:</strong></label>
									<input type="text" id="accountingName" name="accountingName" class="inputbox" value="<?=$company["accountingName"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="accountingEmail"><strong>Email:</strong></label>
									<input type="text" id="accountingEmail" name="accountingEmail" class="inputbox" value="<?=$company["accountingEmail"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
						<div>
							<div style="float:left;">
								<p>
									<label for="treasuryName"><strong>Contacto Tesorer&iacute;a:</strong></label>
									<input type="text" id="treasuryName" name="treasuryName" class="inputbox" value="<?=$company["treasuryName"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="treasuryEmail"><strong>Email:</strong></label>
									<input type="text" id="treasuryEmail" name="treasuryEmail" class="inputbox" value="<?=$company["treasuryEmail"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
						<div>
							<div style="float:left;">
								<p>
									<label for="hrName"><strong>Responsable de Gesti&oacute;n Humana:</strong></label>
									<input type="text" id="hrName" name="hrName" class="inputbox" value="<?=$company["hrName"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="hrEmail"><strong>Email:</strong></label>
									<input type="text" id="hrEmail" name="hrEmail" class="inputbox" value="<?=$company["hrEmail"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
						<div>
							<div style="float:left;">
								<p>
									<label for="securityName"><strong>Responsable de Seguridad:</strong></label>
									<input type="text" id="securityName" name="securityName" class="inputbox" value="<?=$company["securityName"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="securityEmail"><strong>Email:</strong></label>
									<input type="text" id="securityEmail" name="securityEmail" class="inputbox" value="<?=$company["securityEmail"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
						<div>
							<div style="float:left;">
								<p>
									<label for="logisticsName"><strong>Responsable de Logistica y Operaciones:</strong></label>
									<input type="text" id="logisticsName" name="logisticsName" class="inputbox" value="<?=$company["logisticsName"]?>" /> <br />
								</p>
							</div>
							<div style="float:left;">
								<p>
									<label for="logisticsEmail"><strong>Email:</strong></label>
									<input type="text" id="logisticsEmail" name="logisticsEmail" class="inputbox" value="<?=$company["logisticsEmail"]?>" /> <br />
								</p>
							</div>
						</div>
						<div style="clear:both;"></div>
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
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>
<script>
	$(function() {
		$("#invoiceDueDate").datepicker({dateFormat:'yy-mm-dd'});
	});
</script>