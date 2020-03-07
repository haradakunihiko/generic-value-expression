<?php
namespace GenericValueExpression\Executor\Expression\Func;

use GenericValueExpression\Executor\Expression\Expression;

class ConcatFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        return join($this->getGlue(), array_map(function(Expression $expression) use($dataSource) {
            return $expression->evaluate($dataSource);
        }, $this->expressions));
    }

    private function getGlue()
    {
        return $this->value || '';
    }
}
