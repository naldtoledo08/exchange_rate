<?php
require_once __DIR__ . '/vendor/autoload.php';
use Services\BinService;

$binService = new BinService();

$file = file_get_contents($argv[1]);
$binDatas = explode("\n", file_get_contents($argv[1]));

foreach ($binDatas as $row) {

    if (empty($row))
    	break;

    $rowData = json_decode($row);

	$binInformation = $binService->getBinInformation($rowData->bin);    
    
    $fixedAmount = $binService->getFixAmount($rowData->currency, $rowData->amount);

    echo $binService->getCommission($fixedAmount, $binInformation->country->alpha2);
    print "\n";
}
?>