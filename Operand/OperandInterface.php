<?php

namespace Calculator\Operand;

interface Operand {

    public function __construct($leftValue, $rightValue);

    public function setRightValue($value);

    public function setLeftValue($value);

    public function evaluate();

}