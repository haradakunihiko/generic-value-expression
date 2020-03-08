<?php


namespace GenericValueExpression\Executor\Expression\Aggregator;


use GenericValueExpression\Executor\Expression\Expression;

class CountAggregator extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $targetExpression, */
        [ $targetExpression ] = $this->expressions;

        return count($targetExpression->evaluate($dataSource));
    }
}
