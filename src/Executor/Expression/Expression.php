<?php
namespace GenericValueExpression\Executor\Expression;

abstract class Expression
{
    protected $value;
    protected $expressions;

    public function __construct($value, $expressions)
    {
        $this->value = $value;
        $this->expressions = $expressions;
    }

    abstract public function evaluate(array $dataSource);
}
