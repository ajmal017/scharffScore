<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 10:05 PM
 */
namespace Model\Stocks;

class JSONDataTransformer
{
    /**
     * @var array
     */
    protected $jsonStockData = array();
    /**
     * @var array
     */
    protected $decodedData = array();

    /**
     * JSONDataTransformer constructor.
     * @param $jsonStockData
     * @throws Exception
     */
    public function __construct($jsonStockData)
    {
        $this->setJsonStockData($jsonStockData)->decodeJSONData();
    }

    /**
     * getData
     * @return array
     */
    public function getData()
    {
        return $this->getDecodedData();
    }

    /**
     * decodeJSONData
     * @return $this
     * @throws Exception
     */
    protected function decodeJSONData()
    {
        if (json_decode($this->getJsonStockData()) !== null) {
            $this->setDecodedData(json_decode($this->getJsonStockData(), true, 512));
        }
        else {
            throw new \Exception('Not valid JSON data from API Call.');
        }

        return $this;
    }


    //GETTERS AND SETTERS

    /**
     * getJsonStockData
     * @return string
     */
    public function getJsonStockData()
    {
        return $this->jsonStockData;
    }

    /**
     * setJsonStockData
     * @param string $jsonStockData
     */
    public function setJsonStockData($jsonStockData)
    {
        $this->jsonStockData = $jsonStockData;
        return $this;
    }

    /**
     * getDecodedData
     * @return array
     */
    public function getDecodedData()
    {
        return $this->decodedData;
    }

    /**
     * setDecodedData
     * @param array $decodedData
     */
    public function setDecodedData($decodedData)
    {
        $this->decodedData = $decodedData;
        return $this;
    }






}