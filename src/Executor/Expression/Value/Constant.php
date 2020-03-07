<?php
namespace GenericValueExpression\Executor\Expression\Value;

use GenericValueExpression\Executor\Expression\Expression;

class Constant extends Expression
{
    public function evaluate(array $dataSource)
    {
        return $this->value;
    }
}
