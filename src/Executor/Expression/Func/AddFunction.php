<?php
namespace GenericValueExpression\Executor\Expression\Func;

use GenericValueExpression\Executor\Expression\Expression;

class AddFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        return array_sum(array_map(function(Expression $expression) use($dataSource) {
            return $expression->evaluate($dataSource);
        }, $this->expressions));
    }

}
