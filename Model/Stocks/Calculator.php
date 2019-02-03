<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 9:26 PM
 */
namespace Model\Stocks;

/**
 * Class Calculator
 * @package Model\Stocks
 */
class Calculator
{
    /**
     * Calculator constructor.
     */
    private function __construct()
    {
    }

    /**
     * calculateRate
     * growth rate as percentage.
     * @return float|int
     */
    public static function calculateRate($previousValue, $value)
    {
        $rate = 0;

        if ($previousValue <= $value) {
            $rate = ((($value - $previousValue)/$previousValue) * 100) / 10; //linear growth rate.
        }

        return $rate;
    }
}