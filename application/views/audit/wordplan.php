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
			tr.ocultar td {
			    padding: 0;
		        border: 0;
    			border-bottom: 1px solid;
			}
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
						INFORME PLAN DE ACCI&Oacute;N<br /> 
		Fecha: <?=$date->format("d/m/Y")?>
					</div></td>
				<td align="right"><div style="margin:10px;"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div></td>
			</tr>
		</table>
			<div class="header">
					
					
					
		<form style="float:right;overflow:hidden;clear: left;" method="post" action="<?=SITE_URL ?>public/css/pdf.php">
			<input type="hidden" name="url" value="<?=$url?>">
			<input type="submit" value="Descargar Reporte en PDF">
		</form>
				</div>
				<div class="break"></div>
				<br/><br/><br/>
				<?php foreach($complimentaryRequirements as $requirement):  ?>
   			<table width="100%">
				<thead>
			      	<tr>
			         	<th width="100%"><strong><?=$requirement["number"]?> - <?=$requirement["description"]?></strong></th>
			      	</tr>
		    	</thead>
		    <tbody>
	    		<tr class="ocultar"><td></td></tr>
					<?php /*if (floatval($requirement["number"]) >= 2 ) { ?>
		      <tr>
		       	<td><strong><?=LBL_OBSERVANCECOMMENTS?></strong>
		        <?php
		           $query = "SELECT * FROM `perfil_comentarios` WHERE rData_id = ".$requirement["id"];
					     $res = mysql_query($query);
					     while($reg = mysql_fetch_array($res)){
					   		if(!empty($reg["comentario"]) && $reg["proveedor_id"] != 0) {
					  ?>
						  <p><?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span></p>
						   <?php	} ?>
					    <?php 	} ?>
		           	  </td>
		           	</tr>
		           	<tr>
		           	  <td><strong><?=LBL_AUDITCOMMENTS?></strong>
					    <?php
					        $res = mysql_query($query);
					        while($reg = mysql_fetch_array($res)){
							if(!empty($reg["comentario"]) && $reg["auditor_id"] != 0) {
						?>
						   </p><?=$reg["comentario"]?> <span style="font-style:italic; font-size:10px; font-weight:bold;"><?=$reg['fecha']?></span></p>
						<?php 	} ?>
					    <?php 	} ?>
		           	  </td>
		           	</tr>
		    <?php } */?>
		           	<tr>
		          		<td colspan="1"><strong><?=LBL_REPORTCOMMENTS?></strong>
							<?php
							  $query = "SELECT * FROM `reportcoments` WHERE id_rData = ".$requirement["id"];
							  $res = mysql_query($query);
							  while($reg = mysql_fetch_array($res)){
								echo "<p>".$reg["reportComment"]." <font size='1'><strong><i>".$reg["fecha"]."</i></strong></font><br/></p>";
							  }
							?>
   		               	</td>
		           	</tr>
		      <?php /* if (floatval($requirement["number"]) < 2 ) { ?>
		           	<tr>
                  <td>
                    <label for="audit"><strong>Comentario del Cliente</strong></label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label for="audit"><strong>Concepto del Auditor</strong></label>
                  </td>
                </tr>
          <?php } */?>
		           	<tr>
		           		<td colspan="1">
		           		  <?php if ($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == AUDITOR || $_SESSION["user"]["role"] == PROVEEDOR) { $readonly = ""; } else { $readonly = " readonly='readonly'"; } ?>
						  <label for="audit"><strong><?=LBL_COMPLIMENTARYCOMMENTS?></strong></label><br/><br/>
						  <?php
							$query  = "SELECT * ";
							$query .= "FROM plancoments pl ";
							$query .= "LEFT JOIN users u ";
							$query .= "ON pl.user_id = u.id ";
							$query .= "WHERE pl.id_rData = ".$requirement["id"];
							$res = mysql_query($query);
							while($reg = mysql_fetch_array($res)){
								echo " <font size='1'><strong><i>Registrado por</i></strong></font> ".$reg["username"]." <font size='1'><strong><i> en ".$reg["fecha"]."</i></strong></font><p style='margin-top:0;'>".$reg["planComment"]."</p>";
							}
						  ?>
		           		</td>
		           	</tr> 
		           	</tbody>
				    </table>
    				<? $i++;?>
     				<? endforeach; ?>
		    </div>
		</div>
	</body>
</html>
