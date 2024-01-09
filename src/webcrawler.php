<?php
require 'src/functions/scrapper.php';
require 'src/functions/csv_generator.php';

$url = "https://amleiloeiro.com.br";

$csvFilePath = "data/" . date("Y-m-d") . ".csv";

$data = crawlAmLeiloeiro($url);

createCSV($data, $csvFilePath);
