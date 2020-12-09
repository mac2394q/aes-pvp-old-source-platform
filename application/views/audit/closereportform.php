<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'error.php');
?>
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Cerrar Reporte de Auditor&iacute;a</h2>
			</div>
			<div class="contentbox">
				<p>
<?php
	if(!empty($users)){
		echo "<strong>Usuarios</strong><br/>";
		echo "Se ha enviado una notificación a los siguientes usuarios<br/>";
		foreach($users as $user):
			echo $user["username"]."<br/>";
		endforeach;
	}
?>
				</p>
				<form action="<?=SITE_URL?>audit/closereport/<?=$auditInstance["id"]?>?branch=<?=$_SESSION["branch"]?>" method="post">
					<p>
						<label for="textfield"><strong>Aspectos Relevantes Positivos</strong></label>
						<textarea name="positiveConclussions" class="inputarea regulararea"></textarea>
					</p>
					<p>
						<label for="textfield"><strong>Aspectos de la Competencia de la Organizaci&oacute;n por Mejorar</strong></label>
						<textarea name="improvementConclussions" class="inputarea regulararea"></textarea>
					</p>
					<p>
						<label for="textfield"><strong>Recomendaciones para la Pr&oacute;xima Auditor&iacute;a</strong></label>
						<textarea name="recommendations" class="inputarea regulararea"></textarea>
					</p>
					<p>
						<label for="textfield"><strong>Observaciones del reporte</strong></label>
						<textarea name="obsreport" class="inputarea regulararea"></textarea>
					</p>
					<p class="buttons">
<?php
	if($auditInstance["reportedDate"] == null) { 
?>
						<input type="submit" value="Cerrar Reporte" class="btnalt">
<?php
	} 
?>
						<input type="button" value="Regresar" class="btnalt" onclick="location.replace('<?=SITE_URL?>audit/report/<?=$_SESSION["provider"]?>?branch=<?=$_SESSION["branch"]?>');">
					</p>
				</form>
			</div>
		</div>
<?php
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>