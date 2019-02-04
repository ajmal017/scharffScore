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
     * growth rate percentage represented.
     * @return double
     */
    public static function calculateRate($previousValue, $value, $time = 12)
    {
        $rate = 0;

        if ($previousValue <= 0 || !empty($previousValue)) {
            $previousValue = 1;
        }

        if ($previousValue <= $value) {
            $rate = (pow($value/$previousValue, 1/$time) - 1); //linear growth rate.
        }

        return $rate * 100;
    }

    public static function caculateScharffScore($score)
    {
        $scharffScore = 0;
        if ($score > 100) {
            $scharffScore = 10;
        }
        else {
            $scharffScore = $score/10;
        }

        return $scharffScore;
    }
}