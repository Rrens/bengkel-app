<?php

function check_empty($data)
{
    $result = empty($data) ? '-' : $data;
    return $result;
}
