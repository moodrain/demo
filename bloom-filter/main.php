<?php

$chip = 100000000;
$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->flushAll();

$times = 1;
while($times++ < 100000) {
    $item = uniqid();
    bfAdd('learnBloom', $item);
    if(! bfExists('learnBloom', $item)) {
        echo 1;
    }
}

function bfAdd($key, $item) {
    global $redis;
    global $chip;
    $key = $key . intval(crc32($item) / $chip);
    $redis->setBit($key, crc32($item) % $chip, 1);
    $redis->setBit($key, crc32(md5($item)) % $chip, 1);
    $redis->setBit($key, crc32(sha1($item)) % $chip, 1);
}

function bfExists($key, $item) {
    global $redis;
    global $chip;
    $key = $key . intval(crc32($item) / $chip);
    return $redis->getBit($key, crc32($item) % $chip) &&
        $redis->getBit($key, crc32(md5($item)) % $chip) &&
        $redis->getBit($key, crc32(sha1($item)) % $chip) ;
}