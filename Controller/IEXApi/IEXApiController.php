<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/3/19
 * Time: 11:23 AM
 */

namespace Controller\IEXApi;

use Model\IEXApi\APIClient;

class IEXApiController
{
    const IEX_FILTER_BATCH_QUERY = 'stock/market/batch';
    const IEX_FILTER_DEFAULT_QUERY = 'types=peers,company,logo,earnings,financials&period=quarterly';

    protected $stockStickers = array();
    protected $IEXApi = null;
    protected $IEXGetUrl = '';

    public function __construct($stockStickers = array())
    {
        $this->setIEXApi();

        if (!empty($stockStickers)) {
            $this->setStockStickers($stockStickers)->setIEXGetUrl()->setIEXData();
        }
    }

    public function query()
    {
        return $this->IEXApi->query();
    }

    //GETTERS and SETTERS:

    /**
     * getStockStickers
     * @return array
     */
    public function getStockStickers()
    {
        return $this->stockStickers;
    }

    /**
     * setStockStickers
     * @param array $stockStickers
     */
    public function setStockStickers($stockStickers)
    {
        $this->stockStickers = implode(',', $stockStickers);
        return $this;
    }

    /**
     * getIEXAPI
     * @return object
     */
    public function getIEXApi()
    {
        return $this->IEXApi;
    }

    /**
     * @param null $IEXApi
     */
    public function setIEXApi()
    {
        $this->IEXApi = new APIClient();
        return $this;
    }

    /**
     * @return string
     */
    public function getIEXGetUrl()
    {
        return $this->IEXGetUrl;
    }

    /**
     * @param string $IEXGetUrl
     */
    public function setIEXGetUrl()
    {
        $this->IEXGetUrl .= self::IEX_FILTER_BATCH_QUERY . '?symbols=' . $this->getStockStickers();
        $this->IEXGetUrl .= '&' .  self::IEX_FILTER_DEFAULT_QUERY;
        return $this;
    }

    public function setIEXData()
    {
        $this->IEXApi->setFilter($this->getIEXGetUrl());
        return $this;
    }
}