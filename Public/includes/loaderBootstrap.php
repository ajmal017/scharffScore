<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 5:14 PM
 */

CONST ROOT_DIR        = '/Users/willscharff/PhpstormProjects/stockApp';
CONST MODEL_PATH      = ROOT_DIR . '/Model/';
CONST CONTROLLER_PATH = ROOT_DIR . '/Controller/';
CONST VIEW_PATH = ROOT_DIR . '/View/';

require_once ROOT_DIR . "/vendor/autoload.php";
require_once 'Loader.php';

$loaderObject = new Loader();
