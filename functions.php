<?php


function arrFiles($path)
{
    $files = scandir($path, 0);
    $correctFiles = array_diff($files, ['.', '..']);
    return $correctFiles;
}

function validate(array $params)
{
    $str = '';
    foreach ($params as $name => $param) {
        if (empty($param)) {
            $str .= 'Поле ' . $name . ' обязательно для заполнения.' . PHP_EOL;
        }
    }
    if (empty($str)) {
        return true;
    } else {
        return $str;
    }
}