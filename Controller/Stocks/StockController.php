<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 5:24 PM
 */

namespace Controller\Stocks;

use Model\Stocks\JSONDataTransformer;

class StockController
{
    protected $stockData = array();
    protected $calculator = null;

    public function __construct($stockData)
    {
        $this->setStockData($stockData);
    }


    //Getters and Setters

    public function getStockData()
    {
        return $this->stockData;
    }


    public function setStockData($stockData)
    {
        $this->stockData = $stockData;
        return $this;
    }





}