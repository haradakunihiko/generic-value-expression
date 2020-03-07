<?php
namespace GenericValueExpression\Executor\Expression\Value;

use GenericValueExpression\Executor\Expression\Expression;

class Variable extends Expression
{
    public function evaluate(array $dataSource)
    {
        return $dataSource[$this->value];
    }
}
