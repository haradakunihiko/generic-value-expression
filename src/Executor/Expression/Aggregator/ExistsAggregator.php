<?php
namespace GenericValueExpression\Executor\Expression\Aggregator;

use GenericValueExpression\Executor\Expression\Expression;

class ExistsAggregator extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $targetExpression, */
        /** @var Expression $aggregateExpression, */
        [$targetExpression, $aggregateExpression] = $this->expressions;

        return count(array_filter($targetExpression->evaluate($dataSource), function($partialDataSource) use ($aggregateExpression){
            return $aggregateExpression->evaluate($partialDataSource);
        })) > 0;
    }
}
