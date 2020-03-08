<?php


namespace GenericValueExpression\Executor\Expression\Aggregator;


use GenericValueExpression\Executor\Expression\Expression;

class SumAggregator extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $targetExpression, */
        /** @var Expression $mapExpression, */
        [$targetExpression, $mapExpression] = $this->expressions;

        return array_sum(array_map( function($partialDataSource) use ($mapExpression){
            return $mapExpression->evaluate($partialDataSource);
        }, $targetExpression->evaluate($dataSource)));
    }
}
