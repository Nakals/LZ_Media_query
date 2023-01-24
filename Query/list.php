<?php
require_once("../etc/config.php");
require_once(APP_ROOT."/Class/queryAPI.php");
require_once(APP_ROOT."/etc/dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;
function return_PDF_to_API(){
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans'); 
$dompdf = new Dompdf($options);    
$query = new Query();
$html = "<style>body{color: #384047;font-family: 'DejaVu Sans', sans-serif;}table {max-width: 960px;margin: 10px auto;}thead th {font-weight: 400;background: #8a97a0;color: #fff;}tr{background: #f4f7f8;border-bottom: 1px solid #fff;margin-bottom: 5px;}tr:nth-child(even) {background: #e8eeef;}th,td{text-align: left;padding: 20px;font-weight: 300;}</style>";
$html.="<table><caption>Очередь</caption><thead><tr><th>ИМЯ</th><th>ФАМИЛИЯ</th><th >Дата и Время Доб.</th></tr></thead><tbody>";
$result=$query->get_person();
    
if($result->num_rows > 0){   
	while ($item = $result->fetch_assoc()) {
        $html.="<tr><th>".$item["name"]."</th><td>".$item["surname"]."</td><td>".$item["added"]."</td></tr>";
    }    
    $html.="</tbody></table>";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    echo base64_encode($dompdf->output());
    
    http_response_code(200);     
}else{     
    http_response_code(404);   
    echo json_encode(
    array("message" => "Error")
    );
} 
}
return_PDF_to_API();
?>