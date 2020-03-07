<?php
namespace GenericValueExpression\Executor\Expression;

use GenericValueExpression\Executor\Expression\Condition\AndCondition;
use GenericValueExpression\Executor\Expression\Condition\EqualsCondition;
use GenericValueExpression\Executor\Expression\Condition\MoreThanCondition;
use GenericValueExpression\Executor\Expression\Func\CountFunction;
use GenericValueExpression\Executor\Expression\Func\IfFunction;
use GenericValueExpression\Executor\Expression\Value\Constant;
use GenericValueExpression\Executor\Expression\Value\Variable;

class Parser
{
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
        switch($type) {
            case 'constant':
                return new Constant($value, $expressions);
            case 'variable':
                return new Variable($value, $expressions);
            case 'and':
                return new AndCondition($value, $expressions);
            case 'equals':
                return new EqualsCondition($value, $expressions);
            case 'if':
                return new IfFunction($value, $expressions);
            case 'morethan':
                return new MoreThanCondition($value, $expressions);
            case 'count':
                return new CountFunction($value, $expressions);
        }
    }
}
