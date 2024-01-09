<?php

function FormatDateToExcel($stringData){

    $data = [];

    $pattern = '/(\w+), (\d+\/\d+\/\d+) - (\d+:\d+h) - R\$ ([\d,.]+)/';
    preg_match($pattern, $stringData, $matches);


    $data = $matches[2]; 
    $hora = $matches[3]; 

    $dataEHoraFormatada = $data . " "  . $hora;

    return $dataEHoraFormatada;
}