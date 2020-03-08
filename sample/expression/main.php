<?php

require 'vendor/autoload.php';
use GenericValueExpression\Executor\Expression\Parser;

echo '単純な計算' . PHP_EOL;
$engine = Parser::parse(json_decode(file_get_contents('sample/expression/tanjun_na_yatu.json'), true));
echo $engine->evaluate([
    "prefecture" => "東京",
    "city" => "杉並"
]) . PHP_EOL;

echo $engine->evaluate([
    "prefecture" => "東京",
    "city" => "豊島"
]) . PHP_EOL;


echo 'itemsに、OL001-I000001が3以上かつOL001-I000002を含むという条件' . PHP_EOL;
$engine = Parser::parse(json_decode(file_get_contents('sample/expression/shipment_no_item_wo_check.json'), true));
echo $engine->evaluate([
    'items' => [
        ['uid' => 'OL001-I000001']
    ]
]) . PHP_EOL;

echo $engine->evaluate([
        'items' => [
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
        ]
    ]) . PHP_EOL;


echo $engine->evaluate([
        'items' => [
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000002'],
        ]
    ]) . PHP_EOL;

echo $engine->evaluate([
        'items' => [
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000001'],
            ['uid' => 'OL001-I000002'],
        ]
    ]) . PHP_EOL;
