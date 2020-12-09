		</div>
		<!-- Right Side/Main Content End -->

		<!-- Left Dark Bar Start -->
		<div id="leftside">
			<div class="user">
				<p>Logged in as:</p>
				<p class="username"><?=$_SESSION["user"]["fullname"]?></p>
				<p class="userbtn"><a href="<?=SITE_URL ?>auth/logout" title="">Log out</a></p>
				<p class="userbtn"><a href="<?=SITE_URL ?>catalog/udppass" title="" style="width:90px">Modificar Clave</a></p>
			</div>

			<ul id="nav">
				<li>
					<ul class="navigation">
<?php
	if($controller == "dashboard") {
		$css = ' class="heading selected"';
	} else {
		$css = '';
	}
?>
						<li<?=$css?>><a href="<?=SITE_URL ?>dashboard/main" title="">Dashboard</a></li>
						<!--<li<?=$css?>><a href="<?=SITE_URL ?>audit/app2" title="">Estadisticas de Auditoria</a></li>-->
					</ul>
				</li>
<?php
	if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR) {
?>
				<li>
					<a class="collapsed heading">Administraci&oacute;n</a>
					 <ul class="navigation" style="display: none; ">
						<li><a href="<?=SITE_URL ?>catalog/companies" title="">Empresas</a></li>
						<li><a href="<?=SITE_URL ?>catalog/statuss" title="">Estatus</a></li>
						<li><a href="<?=SITE_URL ?>catalog/sectors" title="">Sectores</a></li>
						<li><a href="<?=SITE_URL ?>catalog/users" title="">Usuarios</a></li>
						<li><a href="<?=SITE_URL ?>templates/main" title="">Plantillas</a></li>
					</ul>
				</li>
<?php
	 }

	if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR) {
?>
				<li>
					<a class="collapsed heading">Coordinaci&oacute;n</a>
					 <ul class="navigation" style="display: none; ">
						<li><a href="<?=SITE_URL ?>audit/listall" title="">Coordinar Auditor&iacute;as</a></li>
					</ul>
				</li>
<?php
	 }

	if ($_SESSION["user"]["role"] == CLIENTE || $_SESSION["user"]["role"] == PROVEEDOR) {
?>
				<li><a class="expanded heading">Socio</a>
					<ul class="navigation">
						<li><a href="<?=SITE_URL ?>company/main/<?=$_SESSION['company']?>" title="" class="likelogin"> Informaci&oacute;n de la Empresa</a></li>
					</ul>
				</li>
<?php
	}
?>
				<li><a class="expanded heading">Auditor&iacute;a</a>
					<ul class="navigation">
<?php
	if ($_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == SA) {
?>
						<li><a href="<?=SITE_URL ?>audit/accept" title="" class="likelogin">Confirmar Auditor&iacute;as</a></li>
						<li><a href="<?=SITE_URL ?>audit/plans" title="" class="likelogin">Planes de Auditor&iacute;a</a></li>
						<li><a href="<?=SITE_URL ?>audit/close" title="" class="likelogin">Cerrar Auditor&iacute;as</a></li>
<?php
	}else if($_SESSION["user"]["role"] == PROVEEDOR){
?>
						<li><a href="<?=SITE_URL ?>audit/plans" title="" class="likelogin">Planes de Auditor&iacute;a</a></li>
<?php
	}


	if (isset($requirements)) {
		if(isset($editedRequirement))
			$selectedRequirement = $editedRequirement["id"];
		else
			$selectedRequirement = 0;
		$i = count($requirements);
		$a = 1;		

		foreach($requirements as $requirement):

			switch($requirement['status']){
				// Not Updated
				case ND:
					$image = "icon_bullet.png";
					break;
				// No Conformity
				case NC:
					$image = "icon_unapprove.png";
					break;
				// OK
				case OK:
					$image = "icon_approve.png";
					break;
				case NA:
					$image = "icon_approve.png";
					break;
			}

			if($requirement["id"] == $selectedRequirement){
				$css = " class='selected'";
			}else{
				$css = "";
			}
?>
						<li<?=$css?>><a href="<?=SITE_URL ?>audit/edit/<?=$requirement["id"]?>" title="" class="likelogin"><img src="<?=SITE_URL?><?=IMG_LOCATION?>icons/<?=$image?>">&nbsp;<?=$requirement["name"]?> - <?=$requirement["number"]?></a></li>
<?php
			if($a == $i){
				if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR || $_SESSION["user"]["role"] == AUDITOR) {
?>
						<li><a href="<?=SITE_URL ?>audit/main/<?=$_SESSION["provider"]?>?r=1&b=<?=$_SESSION['branch']?>" title="" class="likelogin">PERFIL DE SEGURIDAD REVISADO</a></li>
<?php			}
			}
		$a++;
		endforeach;
?>

<?php
	 }
?>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Left Dark Bar End -->
