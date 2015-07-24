<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: CliEndpoint.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - CliEndpoint
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 23.07.2015
 * Time: 14:19
 */

namespace Core;


abstract class CliEndpoint
{
    /**
     * Instance of object
     * @var null|$this
     */
    protected static $instance = null;

    /**
     * Options from command line
     * @var array
     */
    protected $options = [];

    /**
     * Get instance
     *
     * @return $this
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Close method construct
     */
    private function __construct()
    {
        $this->setOptions();
        $this->afterConstruct();
    }

    /**
     * Stack of methods for run in child class
     *
     * @return mixed
     */
    abstract protected function afterConstruct();

    /**
     * Close method clone
     */
    private function __clone()
    {
    }

    /**
     * Set options from config
     */
    protected function setOptions()
    {
        $configCmd = Config::get('config_cmd');
        $this->options = getopt($configCmd['short'], $configCmd['long']);
    }
}
