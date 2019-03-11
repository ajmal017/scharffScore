<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 3/10/19
 * Time: 7:11 PM
 */

namespace View;

class BaseView
{
    private $rootDirectory = '';

    public function __construct($rootDirectory)
    {
        $this->setRootDirectory($rootDirectory);
    }

    public static function renderCSSIncludes()
    {
        $html = '
            <link rel="stylesheet" type="text/css" href="/includes/semantic/semantic.min.css">
        ';

        return $html;
    }

    public static function renderJSIncludes()
    {
        $html = '
            <script
              src="https://code.jquery.com/jquery-3.1.1.min.js"
              integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
              crossorigin="anonymous"></script>
            <script src="/includes/semantic/semantic.min.js"></script>
        ';

        return $html;
    }

    /**
     * @return string
     */
    public function getRootDirectory()
    {
        return $this->rootDirectory;
    }

    /**
     * @param string $rootDirectory
     */
    public function setRootDirectory($rootDirectory)
    {
        $this->rootDirectory = $rootDirectory;
    }



}