<?php
		require_once(ROOT . DS . 'config' . DS . 'config.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
		$bd = mysql_select_db(DB_NAME) or die ("Verifique la Base de Datos");

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
		$url_explode = explode('?', $url);
		$date = new DateTime($auditInstance["reportedDate"]);
		if($_GET['y'] != ''){
			$year = $_GET['y'];
		} else {
			$year = $date->format("Y");
		}
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
			th {border:solid #000 1px; padding:2px; background-color:#00789F; color: #fff; text-align:left;}
			td {border:solid #000 1px; padding:2px;}
			.left {float:left; width:150px;}
			.right {float:left;}
			.break {clear:both; height:10px;}
			table.table{
				background-color: #005699;
				  border: none;
				  width: 100%;
				  padding: 0;
				  border-spacing: 0px;
			}
			table.table td{
				border:none; 
				color: #fff;
				margin: 0;
				padding: 0;
			}
			.ocultar{
				padding: 0 !important;
				border: 0 !important;
			}
			tr.ocultar td {
			    padding: 0;
		        border: 0;
    			border-bottom: 1px solid;
			}
		</style>
		</style>
	</head>
	<body>

		<div class="contentcontainer">
			<div class="contentbox">

			<table  class="table">
			<tr>
				<td><div style="margin:10px;"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>pvp_logo.png" alt="PVP"/></div></td>
				<td align="center"><div class="right">
						AES<br />
						PROGRAMA DE VERIFICACI&Oacute;N DE PROVEEDORES<br />
						INFORME AUDITOR&Iacute;A Y VALIDACI&Oacute;N<br />
		Fecha: <?=$date->format("d/m/Y")?>
					</div></td>
				<td align="right"><div style="margin:10px;"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div></td>
			</tr>
		</table>
				<div class="header">					
					<form style="float:right;overflow:hidden; clear: left;" method="post" action="<?=SITE_URL ?>public/css/pdf.php">
						<input type="hidden" name="url" value="<?=$url?>">
						<input type="submit" value="Descargar Reporte en PDF">
					</form>
					<div style="clear:both"></div>
					<div style="float:right;overflow:hidden;">
						<form><div style="float:left;overflow:hidden;margin-right:10px;"><h4>Reporte por A&ntilde;o</h4></div>
						<div style="float:right;overflow:hidden;margin-top:18px;"><select id="#word__year" onchange="location.href='<?php echo $url_explode[0]?>?y='+this.value">
							<option value="">Año diferente</option>
							<?php for($i=2010; $i<=date("Y"); $i++){ ?>
								<option value="<?php echo $i?>" <?php if($year == $i ){echo "selected"; } ?>><?php echo $i?></option>
							<?php } ?>
						</select></div>
						</form>
					</div>

				</div>
				<div class="break"></div>
				<br/><br/><br/>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="3"><b>1. INFORMACI&Oacute;N GENERAL DE LA ORGANIZACI&Oacute;N</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
						<tr>
							<td colspan="1">RAZ&Oacute;N SOCIAL</td>
							<td colspan="2"><?=utf8_encode($company["socialName"])?></td>
						</tr>
						<tr>
							<td colspan="1">LUGAR DONDE SE REALIZ&Oacute; LA AUDITOR&Iacute;A</td>
							<td colspan="2"><?=utf8_encode($company["postalAddress"])?>, <?=utf8_encode($company["city"])?></td>
						</tr>
						<tr>
							<td colspan="1">SEDE AUDITADA</td>
							<td colspan="2"><?=utf8_encode($branch["name"])?></td>
						</tr>
						<tr>
							<td colspan="1">ALCANCE</td>
							<td colspan="2"><?=utf8_encode($auditInstance["scope"])?></td>
						</tr>
						<tr>
							<td colspan="1">CRITERIOS DE AUDITOR&Iacute;A</td>
							<td colspan="2"><?=utf8_encode($auditInstance["criteria"])?></td>
						</tr>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="3"><b>2. REPRESENTANTE DE LA ORGANIZACI&Oacute;N</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
						<tr>
							<td colspan="1">NOMBRE</td>
							<td colspan="2"><?=utf8_encode($company["legalRepresentative"])?></td>
						</tr>
						<tr>
							<td colspan="1">CARGO</td>
							<td colspan="2"><?=utf8_encode($company["carge"])?></td>
						</tr>
						<tr>
							<td colspan="1">CORREO ELECTR&Oacute;NICO</td>
							<td colspan="2"><?=$company["email"]?></td>
						</tr>
						<tr>
							<td colspan="1">TIPO DE AUDITOR&Iacute;A</td>
							<td colspan="2"><?=$auditType["name"]?></td>
						</tr>
<?php /*
						<tr>
							<td>FECHA VALIDACI&Oacute;N PERF&Iacute;L DE SEGURIDAD</td>
							<td><?=$auditInstance["closeReportDate"]?></td>
						</tr>
 */
 ?>
						<tr>

							<td colspan="3"><b>EQUIPO AUDITOR</b></td>
						</tr>
						<tr>
							<td colspan="1">Auditor L&iacute;der</td>
							<td colspan="2"><?=utf8_encode($auditor["fullname"])?></td>
						</tr>
<?php	// Si tiene auditorías previas, tomar la primera
if(true){ ?>
						<tr>
							<td colspan="3"><b>DATOS DEL CERTIFICADO DE CERTIFICACI&Oacute;N DE AES</b></td>
						</tr>
						<tr>
							<td colspan="1">C&oacute;digo</td>
							<td colspan="2"><?=$company["code"]?></td>
						</tr>
<?php /*
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
						</tr> */?>
<?php	} ?>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="3"><b>3. OBJETIVOS DE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
						<tr>
							<td colspan="3">
<?php 	/*if(count($activities) > 0) {
			foreach($activities as $activity): ?>
				<?=$activity["auditor"]?><br/>
				<?=$activity["auditDate"]?><br/>
				<?=$activity["description"]?><br/>
<?php
			endforeach;
		}*/
							echo utf8_encode($auditInstance["auditObjectives"]);
?>
							</td>
						</tr>
					</tbody>
				</table>
				        <table width="100%">
          <thead>
            <tr>
              <th colspan="3"><b>3.1 HALLAZGOS DE LA AUDITOR&Iacute;A</b></th>
            </tr>
          </thead>
          <tbody>
          	<tr class="ocultar"><td></td></tr>
            <tr>
              <td colspan="1">N&uacute;mero de no conformidades detectadas en esta auditor&iacute;a</td>
              <td colspan="2">
              <?php
                $query = "SELECT count(*) AS nV FROM statusreportaudit WHERE status = 1 AND id_auditinstance =".$auditInstance["id"];
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                echo $reg["nV"];
                //echo $nc["numbernc"];
              ?>
              </td>
            </tr>
            <!--<tr>
              <td rowspan="2">N&uacute;mero de no conformidades solucionadas en esta auditor&iacute;a</td>
              <td>Revisi&oacute;n</td>
              <td>
<?php
                /*$query = "SELECT count( * ) as okp FROM okperfilaudit WHERE id_auditinstance = ".$auditInstance["id"];
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                echo $reg["okp"];*/
?>
              </td>
            </tr>
            <tr>
              <td>Validaci&oacute;n</td>
              <td>
<?php
                /*$query = "SELECT count( * ) as okv FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"]." AND sol != 0";
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                echo $reg["okv"];*/
?>
              </td>
            </tr>
            <tr>
              <td rowspan="2">N&uacute;mero de no conformidades pendientes</td>
              <td>Revisi&oacute;n</td>
              <td>
<?php
                /*$query = "SELECT count( * ) as ncp FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"]." AND status = ''";
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                echo $reg["ncp"];*/
?>
              </td>
            </tr>
            <tr>
              <td>Validaci&oacute;n</td>
              <td>
<?php
                /*$query = "SELECT count( * ) as cp FROM requirementsdata WHERE auditinstance = ".$auditInstance["id"];
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                $num = $reg["cp"];
                $query = "SELECT count( * ) as sra FROM `statusreportaudit` WHERE id_auditinstance = ".$auditInstance["id"];
                $res = mysql_query($query);
                $reg = mysql_fetch_array($res);
                echo $num - $reg["sra"];*/
?>
              </td>
            </tr>-->
<?php /*
            <tr>
              <td colspan="3">Observaciones:
                <?=utf8_encode($auditInstance["obsreports"])?>
              </td>
            </tr>
 */ ?>
          </tbody>
        </table>

				<table width="100%">
					<thead>
						<tr>
							<th colspan="3"><b>3.2<!--INFORMACI&Oacute;N RELACIONADA CON LOS SITIOS AUDITADOS--> NO CONFORMIDADES ENCONTRADAS DURANTE EL REPORTE</b></th>
							<!--<th>
								<select id="#word__year" onchange="location.href='<?php //echo $url_explode[0]?>?y='+this.value">
									<option value="">Año diferente</option>
									<?php //for($i=2010; $i<=date("Y"); $i++){ ?>
										<option value="<?php //echo $i?>" <?php //if($year == $i ){echo "selected"; } ?>><?php //echo $i?></option>
									<?php //} ?>
								</select>
							</th>-->
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
<?php

		$query  = "SELECT * , sr.status AS sreport ";
		$query .= "FROM auditinstance ai, requirementsdata rd, reportcoments rc, statusreportaudit sr ";
		$query .= "WHERE ai.id = ".$auditInstance['id']." ";
		$query .= "AND ai.id = rc.id_auditInstance ";
		$query .= "AND rd.id = rc.id_rData ";
		$query .= "AND rd.auditinstance = ai.id ";
		$query .= "AND sr.id_rData = rd.id ";
		$query .= "AND sr.status = 1 ";
		$query .= "AND YEAR(rc.fecha) = '{$year}'";

		$res = mysql_query($query);
		$numrows = mysql_num_rows($res);
		if($numrows > 0){
			$first = '';
			while($reg = mysql_fetch_array($res)){
				if($first != $reg['description']){
					$first = $reg['description'];
?>
						<tr>
							<td style="border:none;" colspan="3">
					<br/><?=$reg["number"]?>&nbsp;&nbsp;<?=utf8_encode($reg["description"])?><br/>
					<b>Comentarios del Auditor Durante el Reporte: </b><br/>
				<?=utf8_encode($reg["reportComment"])?> <b><?=$reg["fecha"]?></b><br/>
							</td>
						</tr>
                 <?php
				}
?>
<?php
			}
		}else{
				print "<tr><td><br></td></tr>";
		}
?>
					</tbody>
				</table>
				<table width="100%">
					<thead>
						<tr>
							<th colspan="6"><b>4. INFORMACI&Oacute;N RELACIONADA CON LOS SITIOS AUDITADOS</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
						<tr>
							<td colspan="1">N&uacute;mero de sedes</td>
							<td colspan="1"><?=count($sedes)?><br/></td>
							<td colspan="1"></td>
							<td colspan="1"></td>
							<td colspan="1">N&uacute;mero de empleados </td>
							<td colspan="1">
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
							<th colspan="3"><b>5. ACTIVIDADES DESARROLLADAS DURANTE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
<?php
		if(count($activities) > 0) {
			foreach($activities as $activity):
?>
						<tr>
							<td colspan="3"><?=utf8_encode($activity["description"])?></td>
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
							<th colspan="3"><b>6. CONCLUSIONES DE LA AUDITOR&Iacute;A</b></th>
						</tr>
					</thead>
					<tbody>
						<tr class="ocultar"><td></td></tr>
						<tr>
							<td colspan="1">Aspectos relevantes positivos</td>
							<td colspan="2"><?=utf8_encode($auditInstance["positiveConclussions"])?></td>
						</tr>
						<tr>
							<td colspan="1">Aspectos de la  competencia de la Organizaci&oacute;n por mejorar</td>
							<td colspan="2"><?=utf8_encode($auditInstance["improvementConclussions"])?></td>
						</tr>
						<tr>
							<td colspan="1">Recomendaciones por tener en cuenta para la pr&oacute;xima auditor&iacute;a</td>
							<td colspan="2"><?=utf8_encode($auditInstance["recommendations"])?></td>
						</tr><?php 	$date = new DateTime($auditInstance["closedDate"]);?>
						<tr>
							<td colspan="1">Auditor L&iacute;der</td>
							<td colspan="2"><?=utf8_encode($auditor["fullname"])?></td>
						</tr>
						<tr>
							<td colspan="1">Fecha</td>
							<td colspan="2"><?=$date->format("d/m/Y")?></td>
						</tr>
					</tbody>
				</table>
<?php
/*
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
*/
?>
			</div>
		</div>
	</body>
</html>
