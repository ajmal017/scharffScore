<?php
/**
 * Created by PhpStorm.
 * Programmer: willscharff
 * Date: 1/20/19
 * Time: 5:10 PM
 */

require "../../vendor/autoload.php";

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

/**
 * Class APIClient
 */
class APIClient
{

    /**
     * $client
     *
     * @var Client|null
     */
    private $client = null;

    /**
     * API_URL
     *
     */
    const API_URL = "https://api.iextrading.com/1.0"; //Example: ?filter=symbol,volume,lastSalePrice will return only the three fields specified.

    /**
     * $filter
     *
     * @var
     */
    private $filter;

    /**
     * APIClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }


    /**
     * query
     *
     * @return array|string
     */
    public function query()
    {
        $results = array();
        try {
            $response = $this->client->get(
                self::API_URL . $this->getFilter(),
                array()
            );
            $results = $response->getBody()->getContents();
        }
        catch (RequestException $e) {
            $results = $e->getMessage();
        }

        return $results;
    }

    //GETTERS AND SETTERS

    /**
     * getFilter
     *
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * setFilter
     *
     * @param mixed $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
        return $this;
    }


}