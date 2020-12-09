<?php
	$mainSelected = ($action == 'main' || $action == 'edit')? " ui-tabs-selected ui-state-active": "";
	$reportSelected = ($action == 'report' || $action == 'savereport')? " ui-tabs-selected ui-state-active": "";
	$complimentarySelected = ($action == 'complimentary' || $action == 'savecomplimentary')? " ui-tabs-selected ui-state-active": "";
?>
			<div class="headings altheading">
				<h2 class="left">Auditor&iacute;a</h2>
				<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top<?=$mainSelected?>"><a href="<?=SITE_URL?>audit/main/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>">Perfil de Seguridad</a></li>
					<li class="ui-state-default ui-corner-top<?=$reportSelected?>"><a href="<?=SITE_URL?>audit/report/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>">Reporte de Auditor&iacute;a</a></li>
					<li class="ui-state-default ui-corner-top<?=$complimentarySelected?>"><a href="<?=SITE_URL?>audit/complimentary/<?=$_SESSION['company']?>?branch=<?=$_SESSION['branch']?>">Plan de Acci&oacute;n</a></li>
				</ul>
			</div>