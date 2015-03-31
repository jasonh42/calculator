<?php

namespace Calculator\Operand;

class Multiply implements Operand {

    private $leftValue;
    private $rightValue;

    /**
     * @param $leftValue
     * @param $rightValue
     */
    public function __construct($leftValue=NULL, $rightValue=NULL) {
        $this->leftValue = $leftValue;
        $this->rightValue = $rightValue;
    }

    /**
     *
     * @return int
     *
     */
    public function evaluate() {
        return $this->leftValue * $this->rightValue;
    }

    /**
     * @param int $leftValue
     *
     * @return $this
     */
    public function setLeftValue($leftValue) {
        $this->leftValue = $leftValue;

        return $this;
    }

    /**
     * @param mixed $rightValue
     *
     * @return $this
     */
    public function setRightValue($rightValue) {
        $this->rightValue = $rightValue;

        return $this;
    }

}