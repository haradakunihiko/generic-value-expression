<?php


namespace GenericValueExpression\Executor\Expression\Func;


use GenericValueExpression\Executor\Expression\Expression;

class MultiplyFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $leftExpression */
        /** @var Expression $rightExpression */
        [ $leftExpression, $rightExpression ] = $this->expressions;
        return $leftExpression->evaluate($dataSource) * $rightExpression->evaluate($dataSource);
    }
}
