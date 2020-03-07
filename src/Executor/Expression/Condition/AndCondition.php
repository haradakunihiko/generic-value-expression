<?php
namespace GenericValueExpression\Executor\Expression\Condition;

use GenericValueExpression\Executor\Expression\Expression;

class AndCondition extends Expression
{
    public function evaluate(array $dataSource): bool
    {
        return count(array_filter($this->expressions, function (Expression $expression) use ($dataSource) {
           return !$expression->evaluate($dataSource);
        })) === 0;
    }
}
