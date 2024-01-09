<?php

function createCSV($data, $file_path)
{
    $csvFile = fopen($file_path, "w");

    fputcsv($csvFile, ["Link", "Data do Primeiro Leilão", "Data do Segundo Leilão", "Preço"]);

    foreach ($data as $row) {
        fputcsv($csvFile, $row);
    }
    fclose($csvFile);
}