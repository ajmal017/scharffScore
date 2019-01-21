<?php
/**
 * Created by PhpStorm.
 * Programmer: willscharff
 * Date: 1/20/19
 * Time: 5:41 PM
 */

require_once("../../Model/IEXApi/APIClient.php");

//Set URL filter for test
$api = new APIClient();
$api->setFilter("/stock/aapl/batch?types=quote,news,chart&range=1m&last=1");
//Query the API.
echo $api->query();