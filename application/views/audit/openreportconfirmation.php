<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Reabrir Reporte de Auditor&iacute;a</h2>
			</div>
			<div class="contentbox">
				<form action="<?=SITE_URL?>audit/openreport/<?=$auditInstance["id"]?>" method="post">
<?php
	if($auditInstance["reportedDate"] != null) {
		if($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN ){
?>
					<span>Confirme que desea abrir el reporte</span>
					<input type="submit" value="Abrir Reporte" class="btnalt">
<?php
		}
	}else{
?>
					<span>El reporte esta abierto</span>
<?php
	}
?>
				</form>
			</div>
		</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>