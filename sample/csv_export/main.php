<?php

require 'vendor/autoload.php';
use GenericValueExpression\Executor\Expression\Parser;
use GenericValueExpression\Executor\Expression\Expression;


// Expressionを用いてCSV定義を行って、データソースを変換させた。
// [
//    [label => 'カラム名', expression => [expression定義]],
//    [label => 'カラム名', expresion => [expression定義]],
// ]

$content =  file_get_contents('sample/csv_export/setting.json');

$data = [
    [
       'uid' => 'OL001-S000001',
       'delivery_carrier_id' => 1,
       'items' => [
           [],
           [],
           [],
       ],
        'box_size' => 'YP1',
        'ken' => '神奈川県',
        'addr1' => '横浜市',
        'addr2' => '青葉区',
        'name' => '原田',
    ],
    [
       'uid' => 'OL001-S000002',
       'delivery_carrier_id' => 4,
       'items' => [
           [],
           [],
       ],
        'box_size' => 'YP2',
        'ken' => '神奈川県',
        'addr1' => '横浜市',
        'addr2' => '青葉区',
        'name' => '原田',
    ],

];

function createRow($rowData, $columnExpressions) {
    return join(",", array_map(function(Expression $expression) use ($rowData) {
        return $expression->evaluate($rowData);
    }, $columnExpressions));
}

function main($data, $setting) {

    echo join(",", array_map(function(array $row) {
        return $row['label'];
    }, $setting)) . PHP_EOL;

    $columnExpressions = array_map(function($columnSetting) {
        return Parser::parse($columnSetting['expression']);
    }, $setting);

    foreach ($data as $row) {
        echo createRow($row, $columnExpressions) . PHP_EOL;
    }
}

main($data, json_decode($content, true));
