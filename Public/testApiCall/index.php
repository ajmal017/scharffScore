<?php
/**
 * Created by PhpStorm.
 * Programmer: willscharff
 * Date: 1/20/19
 * Time: 5:41 PM
 */

require_once("../includes/loaderBootstrap.php");

//Set URL filter for test
$IEXApiControllerObj = new \Controller\IEXApi\IEXApiController(['aapl', 'msft']);
//$stockControllerObj = new \Controller\Stocks\StockController();
$jsonTransformerObj = new \Model\Stocks\JSONDataTransformer($IEXApiControllerObj->query());
$ScharffScoreObj = new \Model\Stocks\ScharffScore($jsonTransformerObj->getData());

//echo $ScharffScoreObj;
//,
//There are 6 categories for the score:
// Equity BVPS (shareholder equity)
// Sales
// EPS
// Cash

// ROIC 1 YEAR
// ROIC 5 YEAR
// Some of the above information may be in: https://iextrading.com/developer/docs/#financials.
//

// The financials does provide:
// 1. Cash flow
// stock/aapl/financials?period=annual, I'd like to have 10 years.

// The earnings does provide
// 2. EPS
// https://api.iextrading.com/1.0/stock/aapl/earnings

// 3. Sales (net income)
// Reviewing if this can be looked up historically.
// /stock/aapl/financials

// 4. BVPS (shareholder equity)
// stock/aapl/financials

// 5. ROIC 1 YEAR:
// /stock/aapl/stats

// 6. ROIC 5 YEAR:


//This API is not giving me the historical data exactly how I would like it: https://ycharts.com/api (costs money)
//https://www.quandl.com/databases/WIKIP/documentation ( might provide some data allows free subscription).
//https://www.quandl.com/databases/SF1 //Free API key: cJv1DvmA5qYDV2xytaxU

//Query the API.
//echo $api->query();