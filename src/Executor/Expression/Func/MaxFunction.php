<?php
namespace GenericValueExpression\Executor\Expression\Func;
use GenericValueExpression\Executor\Expression\Expression;

class MaxFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        return max(
            array_map(function (Expression $expression) use ($dataSource) {
                return !$expression->evaluate($dataSource);
            }, $this->expressions)
        );
    }
}
