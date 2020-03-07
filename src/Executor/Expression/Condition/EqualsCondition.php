<?php


namespace GenericValueExpression\Executor\Expression\Condition;


use GenericValueExpression\Executor\Expression\Expression;

class EqualsCondition extends Expression
{
    public function evaluate(array $dataSource): bool
    {
        /** @var Expression $leftExpression */
        /** @var Expression $rightExpression */
        [ $leftExpression, $rightExpression ] = $this->expressions;

        return $leftExpression->evaluate($dataSource) === $rightExpression->evaluate($dataSource);
    }
}
