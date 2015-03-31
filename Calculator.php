<?php

namespace Calculator;

class Calculator {

    const OPERAND_ADD      = "+";
    const OPERAND_SUBTRACT = "-";
    const OPERAND_MULTIPLY = "*";
    const OPERAND_DIVIDE   = "/";
    const OPERAND_MODULUS  = "%";

    /**
     * Evaluates expression string
     *
     * @param $inputString
     *
     * @return int
     *
     * @throws \Exception
     */
    public function evaluate($inputString) {

        //split the string based off space delimiter (naively assuming string is always well-formed)
        $tokenizedString = explode(" ", $inputString);

        //separate integers and operands into individual arrays
        $expressionValues   = $this->determineValues($tokenizedString);
        $expressionOperands = $this->determineOperands($tokenizedString);

        //evaluate expressions in order of associativity
        foreach ($this->getAssociativityArray() as $operandType) {

            //if this operand is not used in expression, continue to next
            if (!in_array($operandType, $expressionOperands)) {
                continue;
            }

            //loop through the operands that exist in the string
            foreach ($expressionOperands as $key=>$val) {

                //if operand in string matches current operand
                if ($expressionOperands[$key] == $operandType) {

                    //determine which operand to use, and evaluate
                    try {
                        $operandEvaluator = new OperandEvaluator($operandType);
                        $calculation      = $operandEvaluator->evaluate($expressionValues[$key],
                                                                        $expressionValues[$key + 1]);
                    } catch (\Exception $e) {
                        throw new \Exception($e->getMessage());
                    }

                    //this operand, along with its left and right value have been evaluated.
                    //remove from respective arrays.
                    unset($expressionOperands[$key]);
                    unset($expressionValues[$key]);

                    //place evaluated expression where right value previously existed.
                    $expressionValues[$key + 1] = $calculation;
                }
            }

            //reorder arrays for next iteration.
            $expressionValues   = array_values($expressionValues);
            $expressionOperands = array_values($expressionOperands);

        }

        return $expressionValues[0];
    }

    /**
     * @param $tokenizedInputString
     *
     * @return array
     *
     */
    private function determineValues($tokenizedInputString) {

        $values = [];

        //first number starts at index 0, and each subsequent number is two indices away
        for ($pos = 0; $pos < count($tokenizedInputString); $pos += 2) {
            $values[] = $tokenizedInputString[$pos];
        }

        return $values;
    }

    /**
     * @param $tokenizedInputString
     *
     * @return array
     *
     */
    private function determineOperands($tokenizedInputString) {

        $operands = [];

        //first operand starts at index 1, and each subsequent number is two indices away
        for ($pos = 1; $pos < count($tokenizedInputString); $pos += 2) {
            $operands[] = $tokenizedInputString[$pos];
        }

        return $operands;
    }

    /**
     * Order of operations array
     *
     * @return array
     *
     */
    private static function getAssociativityArray() {

        return [self::OPERAND_MULTIPLY,
                self::OPERAND_DIVIDE,
                self::OPERAND_MODULUS,
                self::OPERAND_ADD,
                self::OPERAND_SUBTRACT];

    }



}