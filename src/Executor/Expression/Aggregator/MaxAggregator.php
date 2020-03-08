<?php
namespace GenericValueExpression\Executor\Expression\Func;
use GenericValueExpression\Executor\Expression\Expression;

class MaxAggregator extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $targetExpression, */
        [ $targetExpression ] = $this->expressions;

        return max($targetExpression->evaluate($dataSource));
    }
}
