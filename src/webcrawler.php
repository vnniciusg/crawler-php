<?php
require 'src/functions/scrapper.php';
require 'src/functions/csv_generator.php';

$url = "https://amleiloeiro.com.br";

$csvFilePath = "data/" . date("Y-m-d") . ".xlsx";

$data = crawlAmLeiloeiro($url);

echo "----------------\n";
echo "Dados coletados:\n";

createCSV($data, $csvFilePath);
