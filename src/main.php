<?php

require 'vendor/autoload.php';
use GenericValueExpression\Executor\Expression\Parser;

function createExpressionEvaluateEngine($setting)
{
    return Parser::parse(json_decode($setting, true));
}

echo createExpressionEvaluateEngine(
    '{"type":"if","expressions":[{"type":"and","expressions":[{"type":"equals","expressions":[{"type":"variable","value":"ken"},{"type":"constant","value":"tokyo"}]},{"type":"equals","expressions":[{"type":"variable","value":"city"},{"type":"constant","value":"suginami"}]}]},{"type":"constant","value":"1"},{"type":"constant","value":"0"}]}'
)->evaluate([
    'ken' => 'tokyo',
    'city' => 'suginami',
]) . PHP_EOL;


echo createExpressionEvaluateEngine(
    '{"type":"if","expressions":[{"type":"and","expressions":[{"type":"equals","expressions":[{"type":"variable","value":"ken"},{"type":"constant","value":"tokyo"}]},{"type":"equals","expressions":[{"type":"variable","value":"city"},{"type":"constant","value":"suginami"}]}]},{"type":"constant","value":"1"},{"type":"constant","value":"0"}]}'
)->evaluate(
    [
        'ken' => 'tokyo',
        'city' => 'shibuya',
    ]
) . PHP_EOL;


$engine = createExpressionEvaluateEngine(
    '{"type":"if","expressions":[{"type":"morethan","expressions":[{"type":"count","expressions":[{"type":"variable","value":"items"}]},3]},"many!","less!"]}'
);

echo $engine->evaluate([
    'items' => [
        [],
        [],
        [],
    ]
]) . PHP_EOL;

echo $engine->evaluate([
    'items' => [
        [],
        [],
        [],
        [],
    ]
]) . PHP_EOL;