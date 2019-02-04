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

    protected function processScore($sticker, $iexArrayName, $iexFieldName, $scharffScoreName, $options = array()) {
        $default = [
            'multiplier' => false,
            'multiplerAmount' => 1,
            'time' => '12'
        ];

        $options = array_merge($default, $options);

        $score = 0;

        //if exist calculate the rate for this past year.
        if (isset($this->getStockData()[$sticker][$iexArrayName][$iexArrayName])) {
            $arrayCount = count($this->getStockData()[$sticker][$iexArrayName][$iexArrayName]);
            $previousValue = $this->getStockData()[$sticker][$iexArrayName][$iexArrayName][$arrayCount - 1][$iexFieldName];
            $value = $this->getStockData()[$sticker][$iexArrayName][$iexArrayName][0][$iexFieldName];

            if ($options['multiplier']) {
                $previousValue *= $options['multiplierAmount'];
                $value *= $options['multiplierAmount'];
            }

            $score += Calculator::calculateRate(
                $previousValue,
                $value,
                isset($options['time']) ? $options['time'] : 12 // 12 months
            );
        }

        $scharffScore = Calculator::caculateScharffScore($score);
        $this->setScores($sticker, [$scharffScoreName => $score], $scharffScore);

        return $this;
    }

    protected function processEPSScore($sticker)
    {
        $this->processScore(
            $sticker,
            'earnings',
            'actualEPS',
            'eps'
        );
        return $this;
    }

    protected function processCashFlowScore($sticker)
    {
        $this->processScore(
            $sticker,
            'financials',
            'cashFlow',
            'cashFlow'
        );
        return $this;
    }

    protected function processSalesScore($sticker)
    {
        $this->processScore(
            $sticker,
            'financials',
            'netIncome',
            'sales'
        );
        return $this;
    }

    protected function processEquityScore($sticker)
    {
        $this->processScore(
            $sticker,
            'financials',
            'shareholderEquity',
            'equity'
        );
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

    public function setScores($sticker, $scores, $scharffScore)
    {
        if (isset($this->getScores()[$sticker])) {
            $this->scores[$sticker] += $scores;
        }
        else {
            $this->scores += [$sticker => $scores];
        }
        $this->scores[$sticker]['scharffScore'] += $scharffScore;

        return $this;
    }
}