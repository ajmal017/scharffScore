<?php
/**
 * Created by PhpStorm.
 * Programmer: Will Scharff
 * Date: 2/2/19
 * Time: 5:36 PM
 */

class Loader
{

    /**
     * Controller Directory Path
     *
     * @var Array
     * @access protected
     */
    protected $controllerDirectoryPath = array();

    /**
     * Model Directory Path
     *
     * @var Array
     * @access protected
     */
    protected $modelDirectoryPath = array();

    /**
     * View Directory Path
     *
     * @var Array
     * @access protected
     */
    protected $viewDirectoryPath = array();

    /**
     * Constructor
     * Constant contain my full path to Model, View, Controllers
     *
     */
    public function __construct()
    {
        $this->modelDirectoryPath      = MODEL_PATH;
        $this->controllerDirectoryPath = CONTROLLER_PATH;
        $this->viewDirectoryPath = VIEW_PATH;

        try {
            spl_autoload_register([$this, autoload]);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    /**
     * autoload
     * Load multiple directories
     */
    public function autoload()
    {
        $this->autoloadDirectories($this->modelDirectoryPath);
        $this->autoloadDirectories($this->controllerDirectoryPath);
        $this->autoloadDirectories($this->viewDirectoryPath);
    }

    /**
     * autoloadDirectories
     *
     * @param $dir  string of directory
     */
    public function autoloadDirectories($dir)
    {
        if (!empty($dir)) {
            foreach ( scandir( $dir ) as $file ) {
                if ( is_dir( $dir . $file ) && substr( $file, 0, 1 ) !== '.' ) {
                    $this->autoloadDirectories( $dir . $file . '/' );
                }

                if ( substr( $file, 0, 2 ) !== '._' && preg_match( "/.php$/i" , $file ) ) {
                    set_include_path($dir . $file);
                    spl_autoload_extensions('.php');
                    spl_autoload(str_replace('.php', '', $file));
                    require_once($dir . $file);
                }
            }
        }
    }
}

?>