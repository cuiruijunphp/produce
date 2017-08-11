<?php

    $signature = $_GET['signature'];
    $timestamp = $_GET['timestamp'];
    $nonce = $_GET['nonce'];
    $echostr = $_GET['echostr'];

    $token = 'cuithinking';

    $array = [$nonce,$timestamp,$token];

    sort($array);

    $str = sha1(implode($array));

    if($str == $signature){
        echo  $str;
        exit;
    }else{
        echo 'fail';
        exit;
    }