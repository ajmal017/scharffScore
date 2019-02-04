<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 5:24 PM
 */

namespace Controller\Stocks;

use Model\Stocks\JSONDataTransformer;
use Model\Stocks\ScharffScore;

class StockController
{
    protected $stockJSONData = array();
    protected $stockArrayData = array();
    protected $scharffScore = null;

    public function __construct($stockJSONData)
    {
        $this->setStockJSONData($stockJSONData)
            ->transformJSONData()
            ->setScharffScore();
    }

    public function getScores()
    {
        return $this->getScharffScore()->getScores();
    }

    protected function transformJSONData()
    {
        $jsonTransformerObj = new JSONDataTransformer($this->getStockJSONData());
        $this->setStockArrayData($jsonTransformerObj->getData());
        return $this;
    }

    //Getters and Setters

    public function getStockJSONData()
    {
        return $this->stockJSONData;
    }


    public function setStockJSONData($stockJSONData)
    {
        $this->stockJSONData = $stockJSONData;
        return $this;
    }

    public function getStockArrayData()
    {
        return $this->stockArrayData;
    }

    public function setStockArrayData($stockArrayData)
    {
        $this->stockArrayData = $stockArrayData;
        return $this;
    }

    public function getScharffScore()
    {
        return $this->scharffScore;
    }

    public function setScharffScore()
    {
        $this->scharffScore = new ScharffScore($this->getStockArrayData());
        return $this;
    }









}