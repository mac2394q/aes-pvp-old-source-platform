<?php
$c = curl_init($_POST['url']);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_USERPWD, 'difepape:717799');
$page = curl_exec($c);
curl_close($c);
$page = $page;
$page = str_replace('"', "'", $page);
$page = str_replace('<input type="submit" value="Imprimir">', "", $page);
    require_once("dompdf/dompdf_config.inc.php");
    $html = $page;
     
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    $dompdf->stream("Reporte_auditoria.pdf");