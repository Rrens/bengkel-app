<?php

function check_empty($data)
{
    $result = empty($data) ? '-' : $data;
    return $result;
}

function format_rupiah($nominal)
{
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

function format_rupiah_tanpa_rp($nominal)
{
    return number_format($nominal, 0, ',', '.');
}

function indo_date($date)
{
    $d = substr($date,8,2);
    $m = substr($date,5,2);
    $y = substr($date,0,4);
    return $d.'/'.$m.'/'.$y;
}
