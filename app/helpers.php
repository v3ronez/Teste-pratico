<?php

function layout()
{
    return \Request::is('admin/*') ? 'layouts.admin' : 'layouts.app';
}

function isAdmin()
{
    return \Request::is('admin/*') ? true : false;
}

function encodeBase64($texto)
{
    return isset($texto) ? base64_encode($texto) : null;
}

function decodeBase64($texto)
{
    return isset($texto) ? base64_decode($texto) : null;
}

function mask(string $mask, string $str)
{
    $str = str_replace(" ", "", $str);

    for ($i = 0; $i < strlen($str); $i++) {
        $mask[strpos($mask, "#")] = $str[$i];
    }

    return $mask;
}

function mask_cpf(string $str)
{
    return mask("###.###.###-##", $str);
}

function clear_caracteres(string $str)
{
    return preg_replace('/[^A-Za-z0-9 ]/', '', $str);
}
