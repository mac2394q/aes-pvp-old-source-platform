<?php
		require_once(ROOT . DS . 'config' . DS . 'config.php');
		require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
		require_once(ROOT . DS . 'application' . DS . 'jpgraph' . DS . 'src'. DS .'jpgraph.php');
		require_once(ROOT . DS . 'application' . DS . 'jpgraph' . DS . 'src'. DS .'jpgraph_pie.php');
		require_once(ROOT . DS . 'application' . DS . 'jpgraph' . DS . 'src'. DS .'jpgraph_pie3d.php');
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");		
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$bd = mysql_select_db(DB_NAME,$con) or die ("Verifique la Base de Datos");


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
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Resumen del cumplimiento <?=utf8_encode($company["socialName"])?></title>
	
	<style type="text/css">
		body {font-family: arial, verdana, tahoma; font-size:12px;}
		div.header {font-family: arial, verdana, tahoma; font-size:14px; font-weight:bold;}
		table.table {border:solid #000 1px; border-spacing:0px; margin: 10px 0}
		table.table th {border:solid #000 1px; padding:2px; background-color:#00789F; color: #fff; text-align:left;padding: 5px 15px;}
		table.table td {border:solid #000 1px; padding: 5px 10px;  font-size: 12px;}
		.left {float:left; width:150px;}
		.right {float:left;}
		.break {clear:both; height:10px;}
		table.header{
			background-color: #005699;
			width: 100%;
		}
		table.header td{
			  color: #fff;
  font-size: 14px;
		}
		table.header td form{
			  margin: 0 20px 0 0;
		}
	</style>

	
</head>
<body>



<table class="header" >
	<tr>
		<td height="62px" align="left"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>pvp_logo.png" alt="PVP"/></td>
		<td align="center"  height="62px"><div class="right">
		AES<br />		
		PROGRAMA DE VERIFICACI&Oacute;N DE PROVEEDORES<br />
		INFORME AUDITOR&Iacute;A Y VALIDACI&Oacute;N<br />
	</div></td>
		<td align="center"><form style="float:right;overflow:hidden;" method="post" action="<?=SITE_URL ?>public/css/pdf.php">
		<input type="hidden" name="url" value="<?=$url?>">
		<input type="submit" value="Descargar Reporte en PDF">
	</form></td>
	</tr>
</table>
<div style="clear:both"></div>


<?php 
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'audit' . DS .'audit_cap.php');

		$totalcu = 0;
		$totalnc = 0;
		
		foreach ($arrayCap as $values) {
				$totalcu += $values[1];
				$totalnc += $values[2];
		}
		//print $totalcu;
?>


<?php 
// Some data
$data = array($totalnc,$totalcu);

// Create the Pie Graph. 
$graph = new PieGraph(400,250);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("Estado de la auditoria");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->ExplodeSlice(1);

// Get the handler to prevent the library from sending the
// image to the browser
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);

//$graph->Stroke();
$fileName = IMG_LOCATION."graficos/statusaudit.png";
$graph->img->Stream($fileName);
chmod($fileName, 0777);


?>

<table style="margin-top:60px;">
	<tr>
		<td  valign="middle"><img src="<?=SITE_URL.$fileName; ?>?<?=$_SESSION["user"]["id"].$totalcu.$totalnc; ?>" /></td>
		<td  valign="middle">		
		<table >
			<tr>
				<td style="font-size:14px; font-weight:bold;" valign="middle">Avance:</td>
				</tr>
			<tr>
				<td style="font-size:30px;"><?php print(round(($totalcu*100)/($totalcu + $totalnc), 1)."%");?></td>
				</tr>
			<tr>
				<td  valign="middle">Cumplen <?php print $totalcu; ?></td>
				</tr>
				<tr>
				<td  valign="middle">No cumplen <?php print $totalnc; ?></td>
			</tr>
		</table>
	</td>
	</tr>
</table>
<div class="table">
	<table class="table">
		<tr>
			<td colspan="2"><div class="left" ><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div></td>
			<td colspan="4"><h2>Resumen del cumplimiento <?=utf8_encode($company["socialName"])?></h2></td>
		</tr>
		<tr>
			<th>NUM.</th>
			<th>CAPITULO</th>
			<th align="center">CU</th>
			<th align="center">NC</th>
			<th align="center">NA</th>
			<th align="center">Total Preguntas</th>
		</tr>
        <tbody>
		<?php 
			$i = 1;
			$totalcu = 0;
			$totalnc = 0;
			$totalna = 0;
			$totalpre = 0;
			$totalpre2 = 0;
			foreach ($arrayCap as $key) { 
		?>	
		<tr>
			<td align="center"><strong><?php print $i; ?></strong></td>
			<td><?php print $key[0]; ?></td>
			<td align="center"><?php print $key[1]; ?></td>
			<td align="center"><?php print $key[2]; ?></td>
			<td align="center"><?php print $key[3]; ?></td>
			<td align="center"><?php print $totalpre = $key[1] + $key[2]; ?></td>
		</tr>
		<?php 
				$i++;
				$totalcu += $key[1];
				$totalnc += $key[2];
				$totalna += $key[3];
				$totalpre2 +=  $totalpre;
			} 
		?> 
		<tr>
			<td >&nbsp;&nbsp;</td>
            <td >&nbsp;&nbsp;</td>
			<td align="center"><strong><?php print $totalcu; ?></strong></td>
			<td align="center"><strong><?php print $totalnc; ?></strong></td>
			<td align="center"><strong><?php print $totalna; ?></strong></td>
			<td align="center"><strong><?php print $totalpre2; ?></strong></td>
		</tr>
        </tbody>
	</table>
</div>
</body>
</html>