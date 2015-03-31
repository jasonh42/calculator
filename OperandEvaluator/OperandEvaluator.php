<?php

namespace Calculator;

class OperandEvaluator {

    private $operand;

    /**
     * @param string $operand
     */
    public function __construct($operand) {
        $this->operand = $operand;
    }

    /**
     * Performs evaluation given left/right values
     *
     * @param int $leftValue
     * @param int $rightValue
     *
     * @return int
     *
     */
    public function evaluate($leftValue, $rightValue) {

        $operandEvaluator = $this->determineOperandEvaluator($this->operand);

        return $operandEvaluator->setLeftValue($leftValue)
                                ->setRightValue($rightValue)
                                ->evaluate();

    }

    /**
     * @param $operand
     *
     * @return Operand\Add|Operand\Multiply
     *
     * @throws \Exception
     */
    private function determineOperandEvaluator($operand) {

        switch( $operand ) {
            case Calculator::OPERAND_ADD:
                return new Operand\Add();
                break;
            case Calculator::OPERAND_SUBTRACT:
                return new Operand\Subtract();
                break;
            case Calculator::OPERAND_MULTIPLY:
                return new Operand\Multiply();
                break;
            case Calculator::OPERAND_DIVIDE:
                return new Operand\Divide();
                break;
            case Calculator::OPERAND_MODULUS:
                return new Operand\Modulus();
                break;
            default:
                throw new \Exception("Unable to determine operand $operand");
        }
    }

}