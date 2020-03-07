<?php
namespace GenericValueExpression\Executor\Expression\Func;

use GenericValueExpression\Executor\Expression\Expression;

class CountFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $expression */
        [ $expression ] = $this->expressions;
        return count($expression->evaluate(($dataSource)));
    }
}
