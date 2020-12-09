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

<html>
  <head>

    <?php
      $query = " SELECT a1.name, count(a1.name) as totalauditorias ,
       ( select count(a2.status) from requirementsdata a2 where a2.status = 2 and a1.name = a2.name ) as auditoriascompletadas
       FROM requirementsdata a1 where a1.status group by a1.name ";
			 if(isset($con)) {
				 	$response = mysql_query("SELECT a1.name, count(a1.name) as totalauditorias ,
		       ( select count(a2.status) from requirementsdata a2 where a2.status = 2 and a1.name = a2.name ) as auditoriascompletadas
		       FROM requirementsdata a1 where a1.status group by a1.name order by totalauditorias desc");
					  $strArrayCol2 = "['',";
						$strArrayCol3 = "['',";
					  $strArray = "[['',";
					 while($row = mysql_fetch_array($response)) {
						 $strArray = $strArray."'".$row[0]."',";
						 $strArrayCol2 = $strArrayCol2.$row[1].",";
						 $strArrayCol3 = $strArrayCol3.$row[2].",";
						 $strArrayTable =  $strArrayTable."['".$row[0]."', {v:".$row[1]."},".$row[2]."],";
 					}
			 }
			 $strArrayCol2 = $strArrayCol2 . "]],";
			 $strArrayCol3 = $strArrayCol3 . "]],";
			 $strArray = $strArray . "],";


    ?>
		<!-- TOTAL AUDITORIAS -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1');   // Don't need to specify chart libraries!
      google.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          dataTable: <?php print($strArray); ?>
                      <?php print($strArrayCol2); ?>
          options: {'title': 'Total de Auditorias'},
          containerId: 'vis_div'
        });
        wrapper.draw();
      }
    </script>

		<script type="text/javascript">
      google.load('visualization', '1');   // Don't need to specify chart libraries!
      google.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
          chartType: 'ColumnChart',
          dataTable: <?php print($strArray); ?>
                      <?php print($strArrayCol3); ?>
          options: {'title': 'Total Auditorias Complatadas'},
          containerId: 'vis_div1'
        });
        wrapper.draw();
      }

			google.load('visualization', '1', {packages:["table"]});
      google.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Nombre');
        data.addColumn('number', 'Total Auditorias');
        data.addColumn('number', 'Total Auditorias Completadas');
        data.addRows([
          <?php
						print $strArrayTable;
					 ?>
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '800px', height: '600px'});
      }

    </script>

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
  <body style="font-family: Arial;border: 0 none;">
			<div style="margin-left:360px"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div>
		<div class="contentcontainer">
			<div class="contentbox">
				<div class="header">
					<div class="left"><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>company_logo2.png" alt="AES"/></div>
					<div class="right">
						PROGRAMA DE VERIFICACI&Oacute;N DE PROVEEDORES<br />
						AES<br />
						INFORME AUDITOR&Iacute;A Y VALIDACI&Oacute;N<br />
		Fecha: <?=$date->format("d/m/Y")?>
					</div>
				</div>

				<div class="clear"></div>

				<div id="vis_div" style="width: 800px; height: 600px;"></div>
				<div id="vis_div1" style="width: 800px; height: 600px;"></div>

				<div id="table_div"></div>
			</div>
		</div>
	</div>


  </body>
</html>
