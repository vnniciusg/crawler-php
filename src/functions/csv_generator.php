<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function createCSV($data, $file_path)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Link');
    $sheet->setCellValue('B1', 'Data do Primeiro Leilão');
    $sheet->setCellValue('C1', 'Data do Segundo Leilão');
    $sheet->setCellValue('D1', 'Preço');

  

    $rowIndex = 2;
    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowIndex, $row['urlItem']);
        $sheet->setCellValue('B' . $rowIndex, $row['dataPrimeiroLote']);
        $sheet->setCellValue('C' . $rowIndex, $row['dataSegundoLote']);
        $sheet->setCellValue('D' . $rowIndex, $row['valor']);
        $sheet->getStyle('D' . $rowIndex)->getNumberFormat()->setFormatCode('R$ #,##0.00_-');
        $rowIndex++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save($file_path);

    echo "Excel criado com sucesso!\n";

}