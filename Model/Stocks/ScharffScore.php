<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/3/19
 * Time: 11:29 AM
 */

namespace Model\Stocks;


class ScharffScore
{
    protected $stockData = array();
    protected $stickers = array();
    protected $scores = array();

    public function __construct($stockData)
    {
        $this->setStockData($stockData)
            ->processData();

        echo "<pre>" . print_r($this->getScores(), true) . "</pre>";
    }

    protected function processData()
    {
        if (!empty($this->getStockData())) {
            //Set sticker symbols
            $this->setStickers(array_keys($this->getStockData()))
                ->processScores();
        }
        return $this;
    }

    protected function processScores()
    {
        foreach($this->getStickers() as $sticker) {
            $this->processCashFlowScore($sticker)
                ->processEPSScore($sticker)
                ->processSalesScore($sticker)
                ->processEquityScore($sticker)
                ->processROICScore($sticker);
        }

        return $this;
    }

    protected function processEPSScore($sticker)
    {
        $score = 0;
        //if earnings exist calculate the rate for this past year.
        if (isset($this->getStockData()[$sticker]['earnings']['earnings'])) {
            $arrayCount = count($this->getStockData()[$sticker]['earnings']['earnings']);
            $score += Calculator::calculateRate(
                $this->getStockData()[$sticker]['earnings']['earnings'][$arrayCount - 1]['actualEPS'],
                $this->getStockData()[$sticker]['earnings']['earnings'][0]['actualEPS']
            );
        }

        $this->setScores($sticker, ['eps' => $score]);

        return $this;
    }

    protected function processCashFlowScore($sticker)
    {
        $score = 0;
        //if earnings exist calculate the rate for this past year.
        if (isset($this->getStockData()[$sticker]['financials']['financials'])) {
            $arrayCount = count($this->getStockData()[$sticker]['financials']['financials']);
            $score += Calculator::calculateRate(
                $this->getStockData()[$sticker]['financials']['financials'][$arrayCount - 1]['cashFlow'],
                $this->getStockData()[$sticker]['financials']['financials'][0]['cashFlow']
            );
        }

        $this->setScores($sticker, ['cashFlow' => $score]);

        return $this;
    }

    protected function processSalesScore($sticker)
    {
        $score = 0;
        //if earnings exist calculate the rate for this past year.
        if (isset($this->getStockData()[$sticker]['financials']['financials'])) {
            $arrayCount = count($this->getStockData()[$sticker]['financials']['financials']);
            $score += Calculator::calculateRate(
                $this->getStockData()[$sticker]['financials']['financials'][$arrayCount - 1]['netIncome'],
                $this->getStockData()[$sticker]['financials']['financials'][0]['netIncome']
            );
        }

        $this->setScores($sticker, ['sales' => $score]);

        return $this;
    }

    protected function processEquityScore($sticker)
    {
        $score = 0;
        //if earnings exist calculate the rate for this past year.
        if (isset($this->getStockData()[$sticker]['financials']['financials'])) {
            $arrayCount = count($this->getStockData()[$sticker]['financials']['financials']);
            $score += Calculator::calculateRate(
                $this->getStockData()[$sticker]['financials']['financials'][$arrayCount - 1]['shareholderEquity'],
                $this->getStockData()[$sticker]['financials']['financials'][0]['shareholderEquity']
            );
        }

        $this->setScores($sticker, ['equity' => $score]);

        return $this;
    }

    protected function processROICScore($sticker)
    {
        return $this;
    }

    //GETTERS AND SETTERS


    public function getStockData()
    {
        return $this->stockData;
    }


    public function setStockData($stockData)
    {
        $this->stockData = $stockData;
        return $this;
    }


    public function getStickers()
    {
        return $this->stickers;
    }

    public function setStickers($stickers)
    {
        $this->stickers = $stickers;
        return $this;
    }

    public function getScores()
    {
        return $this->scores;
    }

    public function setScores($sticker, $scores)
    {
        if (isset($this->getScores()[$sticker])) {
            $this->scores[$sticker] += $scores;
        }
        else {
            $this->scores += [$sticker => $scores];
        }

        return $this;
    }





}