<?php
namespace GenericValueExpression\Executor\Expression\Func;

use GenericValueExpression\Executor\Expression\Expression;

class IfFunction extends Expression
{
    public function evaluate(array $dataSource)
    {
        /** @var Expression $condition */
        /** @var Expression $trueResult */
        /** @var Expression $falseResult */
        [ $condition, $trueResult , $falseResult] = $this->expressions;

        if ($condition->evaluate($dataSource)) {
            return $trueResult->evaluate($dataSource);
        }
        return $falseResult->evaluate($dataSource);
    }
}
