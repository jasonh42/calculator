<?php

require('Calculator.php');
require('OperandEvaluator/OperandEvaluator.php');
require('Operand/OperandInterface.php');
require('Operand/Add.php');
require('Operand/Subtract.php');
require('Operand/Multiply.php');
require('Operand/Divide.php');
require('Operand/Modulus.php');

$calculator = new \Calculator\Calculator();
echo $calculator->evaluate("1 * 3 + 2 / 2 + 1");
