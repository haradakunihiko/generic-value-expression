<?php
namespace GenericValueExpression\Executor\Expression\Func;

use GenericValueExpression\Executor\Expression\Expression;

class MappingFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $valueExpression */
        /** @var Expression $mappingExpression */
        /** @var Expression $defaultExpression */
        [ $valueExpression, $mappingExpression, $defaultExpression ] = $this->expressions;

        return $mappingExpression->evaluate($dataSource)[$valueExpression->evaluate($dataSource)] ?? $defaultExpression->evaluate($dataSource);
    }
}
