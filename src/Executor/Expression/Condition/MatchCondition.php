<?php
namespace GenericValueExpression\Executor\Expression\Condition;

use GenericValueExpression\Executor\Expression\Expression;

class MatchCondition extends  Expression
{
    public function evaluate(array $dataSource): bool
    {
        /** @var Expression $expression */
        [$expression] = $this->expressions;

        return (bool) preg_match($this->value, $expression->evaluate($dataSource));
    }
}
