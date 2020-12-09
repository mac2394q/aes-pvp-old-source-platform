<?php	
		require_once(ROOT . DS . 'config' . DS . 'config.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		$con = mysql_connect("localhost","hnbacken_memoadi","Rosapadilla23");
		$bd = mysql_select_db("hnbacken_difepape") or die ("Verifique la Base de Datos");
		
		function getUrl() {
			$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
			$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/") . $s;
			$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
			return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
		}
	
		function strleft($s1, $s2) {
			return substr($s1, 0, strpos($s1, $s2));
		}
		
		$url = getUrl();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Reporte de Auditor&iacute;a</title>
		<link href="<?=SITE_URL ?><?=CSS_LOCATION ?>reports.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			body {font-family: arial, verdana, tahoma; font-size:12px;}
			div.header {font-family: arial, verdana, tahoma; font-size:14px; font-weight:bold;}
			table {border:solid #000 1px; border-spacing:0px; margin: 10px 0}
			th {border:solid #000 1px; padding:2px; background-color:#BBAACC; text-align:left;}
			td {border:solid #000 1px; padding:2px;}
			.left {float:left; width:150px;}
			.right {float:left;}
			.break {clear:both; height:10px;}
		</style>
	</head>
	<body>
		<form style="float:right;overflow:hidden;" method="post" action="http://manganimemas.com/difepape/public/css/pdf.php">
			<input type="hidden" name="url" value="<?=$url?>">
			<input type="submit" value="Imprimir">
		</form>
		<div class="contentcontainer">
			<div class="contentbox">
				<div class="header">
					<div class="left"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div>
					<div class="right">
						PROGRAMA DE VERIFICACI&Oacute;N DE PROVEEDORES<br />
						AES<br />
						INFORME AUDITOR&Iacute;A Y VALIDACI&Oacute;N<br />
		<?php
		$date = new DateTime($auditInstance["reportedDate"]);?>
		Fecha: <?=$date->format("d/m/Y")?>
					</div>
				</div>
				<div class="break"></div>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="2"><b>1. INFORMACI&Oacute;N GENERAL DE LA ORGANIZACI&Oacute;N</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="30%">RAZ&Oacute;N SOCIAL</td>
							<td><?=$company["socialName"]?></td>
						</tr>
						<tr>
							<td>LUGAR DONDE SE REALIZ&Oacute; LA AUDITOR&Iacute;A</td>
							<td><?=$company["postalAddress"]?>, <?=$company["city"]?></td>
						</tr>
						<tr>
							<td>ALCANCE</td>
							<td><?=$auditInstance["scope"]?></td>
						</tr>
						<tr>
							<td>CRITERIOS DE AUDITOR&Iacute;A</td>
							<td><?=$auditInstance["criteria"]?></td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="2"><b>2. REPRESENTANTE DE LA ORGANIZACI&Oacute;N</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="30%">NOMBRE</td>
							<td><?=$company["legalRepresentative"]?></td>
						</tr>
						<tr>
							<td>CARGO</td>
							<td><?=$company["carge"]?></td>
						</tr>
						<tr>
							<td>CORREO ELECTR&Oacute;NICO</td>
							<td><?=$company["email"]?></td>
						</tr>
						<tr>
							<td>TIPO DE AUDITOR&Iacute;A</td>
							<td><?=$auditType["name"]?></td>
						</tr>
						<tr>
							<td>FECHA REVISI&Oacute;N  PERF&Iacute;L DE SEGURIDAD</td>
							<td><?=$auditInstance["reviewDate"]?></td>
						</tr>
						<tr>
							<td>FECHA VALIDACI&Oacute;N PERF&Iacute;L DE SEGURIDAD</td>
							<td><?=$auditInstance["closeReportDate"]?></td>
						</tr>
						<tr>
							<td colspan="2"><b>EQUIPO AUDITOR</b></td>
						</tr>
						<tr>
							<td>Auditor L&iacute;der</td>
							<td><?=$auditor["fullname"]?></td>
						</tr>
<?php	// Si tiene auditorías previas, tomar la primera	
if(true){ ?>
						<tr>
							<td colspan="2"><b>DATOS DEL CERTIFICADO DE CERTIFICACI&Oacute;N DE AES</b></td>
						</tr>
						<tr>
							<td>C&oacute;digo</td>
							<td><?=$company["code"]?></td>
						</tr>
						<tr>
							<td>Fecha de otorgamiento (si es aplicable):</td>
							<td><?=$auditInstance["grantDate"]?></td>
						</tr>
						<tr>
							<td>Fecha &uacute;ltima renovaci&oacute;n (si es aplicable):</td>
							<td><?=$auditInstance["renewalDate"]?></td>
						</tr>
						<tr>
							<td>Fecha de Vencimiento (si es aplicable):</td>
							<td><?=$auditInstance["maturityDate"]?></td>
						</tr>
<?php	} ?>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th><b>3. OBJETIVOS DE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
<?php 	/*if(count($activities) > 0) {
			foreach($activities as $activity): ?>
				<?=$activity["auditor"]?><br/>
				<?=$activity["auditDate"]?><br/>
				<?=$activity["description"]?><br/>
<?php
			endforeach; 	
		}*/
							echo $auditInstance["auditObjectives"]
?>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="6"><b>4. <!--INFORMACI&Oacute;N RELACIONADA CON LOS SITIOS AUDITADOS--></b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
<?php
		$query  = "SELECT * FROM auditinstance ai, requirementsdata rd, reportcoments rc ";
		$query .= "WHERE ai.id = ".$auditInstance['id']." ";
		$query .= "AND ai.id = rc.id_auditInstance ";
		$query .= "AND rd.auditinstance = ai.id ";
		$query .= "AND id_rData = rd.id ";
		$query .= "AND rd.isCritical = 1 ";
		$res = mysql_query($query);
		$i = 1;
		while($reg = mysql_fetch_array($res)){
			if($i == 1){
?>
				<?=$reg["description"]?><br/>
				<b/>Comentarios del Auditor Durante el Reporte: </b><br/>
<?php
			}
?>
		<?=$reg["reportComment"]?> <b><?=$reg["fecha"]?></b><br/>
<?php
		$i++;
		}

?>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="6"><b>4. INFORMACI&Oacute;N RELACIONADA CON LOS SITIOS AUDITADOS</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>N&uacute;mero de sedes a auditar</td>
							<td><?=count($sedes)?><br/></td>
							<td>N&uacute;mero de sedes a auditar diferentes a la principal</td>
							<td><?=count($sedes)-1?></td>
							<td>N&uacute;mero de empleados de cada sede a auditar</td>
							<td>
<?php
		foreach($sedes as $s){
			echo "<strong>".$s["name"]."</strong><br/>";
			echo $s["workers"]."<br/>";
		}
?>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="3"><b>5. HALLAZGOS DE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="2" width="30%">N&uacute;mero de no conformidades detectadas en esta auditor&iacute;a (Etapas 1 y 2)</td>
							<td width="20%">Revisi&oacute;n</td>
							<td><?=$nc["numbernc"];?></td>
						</tr>
						<tr>
							<td>Validaci&oacute;n</td>
							<td>
							<?php
								$query = "SELECT count(*) AS nV FROM statusreportaudit WHERE status = 1 AND id_auditinstance =".$auditInstance["id"];
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								echo $reg["nV"];
							?>
							</td>
						</tr>
						<tr>
							<td rowspan="2">N&uacute;mero de no conformidades solucionadas en esta auditor&iacute;a</td>
							<td>Revisi&oacute;n</td>
							<td>
<?php
								$query = "SELECT count( * ) as okp FROM okperfilaudit WHERE id_auditinstance = ".$auditInstance["id"];
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								echo $reg["okp"];
?>
							</td>
						</tr>
						<tr>
							<td>Validaci&oacute;n</td>
							<td>
<?php
								$query = "SELECT count( * ) as okv FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"]." AND sol != 0";
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								echo $reg["okv"];
?>
							</td>
						</tr>
						<tr>
							<td rowspan="2">N&uacute;mero de no conformidades pendientes</td>
							<td>Revisi&oacute;n</td>
							<td>
<?php
								$query = "SELECT count( * ) as ncp FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"]." AND status = ''";
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								echo $reg["ncp"];
?>
							</td>
						</tr>
						<tr>
							<td>Validaci&oacute;n</td>
							<td>
<?php
								$query = "SELECT count( * ) as cp FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"];
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								$num = $reg["cp"];
								$query = "SELECT count( * ) as sra FROM `statusreportaudit` WHERE id_auditinstance = ".$auditInstance["id"];
								$res = mysql_query($query);
								$reg = mysql_fetch_array($res);
								echo $num - $reg["sra"];
?>
							</td>
						</tr>
						<tr>
							<td colspan="3">Observaciones:
								<?=$auditInstance["obsreports"]?>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th><b>6. ACTIVIDADES DESARROLLADAS DURANTE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
<?php
		if(count($activities) > 0) {
			foreach($activities as $activity): 
?>
						<tr>
							<td><?=$activity["description"]?></td>
						</tr>
<?php
			endforeach;
		}
?>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="2"><b>7. CONCLUSIONES DE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td width="30%">Aspectos relevantes positivos</td>
							<td><?=$auditInstance["positiveConclussions"]?></td>
						</tr>
						<tr>
							<td>Aspectos de la  competencia de la Organizaci&oacute;n por mejorar</td>
							<td><?=$auditInstance["improvementConclussions"]?></td>
						</tr>
						<tr>
							<td>Recomendaciones por tener en cuenta para la pr&oacute;xima auditor&iacute;a</td>
							<td><?=$auditInstance["recommendations"]?></td>
						</tr><?php 	$date = new DateTime($auditInstance["closedDate"]);?>
						<tr>
							<td>Auditor L&iacute;der</td>
							<td><?=$auditor["fullname"]?></td>
						</tr>
						<tr>
							<td>Fecha</td>
							<td><?=$date->format("d/m/Y")?></td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="2"><b>8. ANEXOS</b></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach($archives as $archive){ ?>
						<tr>
							<td>Anexo <?=$i?></td>
							<td><?=$archive["nombre"]?></td>
						</tr>
						<?php $i++ ?>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>