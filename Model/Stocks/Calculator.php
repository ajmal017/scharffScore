<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 9:26 PM
 */
namespace Model\Stocks;

class Calculator
{
    protected $previousValue;
    protected $value;

    public function __construct($previousValue, $value)
    {
        $this->setPreviousValue($previousValue)->setValue($value);
    }

    public function calculateRate()
    {
        $rate = 0;

        if ($previousValue <= $value) {
            $rate = ((($value - $previousValue)/$previousValue) * 100) / 10; //linear growth rate.
        }

        return $rate;
    }

    //GETTERS AND SETTERS

    /**
     * @return mixed
     */
    public function getPreviousValue()
    {
        return $this->previousValue;
    }

    /**
     * @param mixed $previousValue
     */
    public function setPreviousValue($previousValue)
    {
        $this->previousValue = $previousValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}