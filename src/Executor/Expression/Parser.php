<?php
namespace GenericValueExpression\Executor\Expression;

use GenericValueExpression\Executor\Expression\Aggregator\CountIfAggregator;
use GenericValueExpression\Executor\Expression\Aggregator\ExistsAggregator;
use GenericValueExpression\Executor\Expression\Aggregator\SumAggregator;
use GenericValueExpression\Executor\Expression\Condition\AndCondition;
use GenericValueExpression\Executor\Expression\Condition\EqualsCondition;
use GenericValueExpression\Executor\Expression\Condition\MoreThanCondition;
use GenericValueExpression\Executor\Expression\Func\AddFunction;
use GenericValueExpression\Executor\Expression\Func\ConcatFunction;

use GenericValueExpression\Executor\Expression\Func\IfFunction;
use GenericValueExpression\Executor\Expression\Func\MappingFunction;
use GenericValueExpression\Executor\Expression\Func\MultiplyFunction;
use GenericValueExpression\Executor\Expression\Value\Constant;
use GenericValueExpression\Executor\Expression\Value\Variable;

class Parser
{
    const MAPPING = [
        'constant' => Constant::class,
        'variable' => Variable::class,
        'and' => AndCondition::class,
        'equals' => EqualsCondition::class,
        'if' => IfFunction::class,
        'morethan' => MoreThanCondition::class,
        'sum' => SumAggregator::class,
        'countif' => CountIfAggregator::class,
        'exists' => ExistsAggregator::class,
        'mapping' => MappingFunction::class,
        'concat' => ConcatFunction::class,
        'add' => AddFunction::class,
        'multiply' => MultiplyFunction::class,
    ];

    public static function parse($expression)
    {
        $expression = self::convert($expression);

        $expressionInstances = array_map(function($expression)  {
            return self::parse($expression);
        }, $expression['expressions'] ?? []);

        return self::newExpressionInstance($expression['type'], $expression['value'] ?? null, $expressionInstances);
    }

    private static function convert($expression)
    {
        if (is_string($expression) || is_numeric($expression)) {
            return [
                'type'=> 'constant',
                'value'=> $expression
            ];
        }

        return $expression;
    }

    private static function newExpressionInstance($type, $value, $expressions): Expression {
        $class = self::MAPPING[$type];
        return new $class($value, $expressions);
    }
}
