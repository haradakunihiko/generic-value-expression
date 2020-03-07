<?php
namespace GenericValueExpression\Executor\Expression\Condition;

use GenericValueExpression\Executor\Expression\Expression;

class MoreThanCondition extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $first */
        /** @var Expression $second */
        [ $first, $second ] = $this->expressions;

        return $first->evaluate($dataSource) > $second->evaluate($dataSource);
    }
}
