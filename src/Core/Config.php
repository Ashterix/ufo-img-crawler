<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: Config.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - Config
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 23.07.2015
 * Time: 14:28
 */

namespace Core;


class Config
{
    /**
     * Path to config folder
     */
    const CONFIG_PATH = '/app/config/';

    /**
     * Name default config file
     */
    const CONFIG_DEFAULT_NAME = 'config';

    /**
     * Extension of config files
     */
    const CONFIG_EXT = '.json';

    /**
     * Name section for import configs from other config files
     */
    const CONFIG_IMPORT_BLOCK = 'imports';

    /**
     * Name resources key
     */
    const CONFIG_IMPORT_RES = 'resource';

    /**
     * It returns a resource configs
     * @var null|array
     */
    private static $config = null;

    /**
     * Return configuration by section
     *
     * @param string $section
     * @return mixed
     */
    public static function get($section)
    {
        if (static::$config === null) {
            static::$config = (array)json_decode(file_get_contents(ROOT_DIR . static::CONFIG_PATH . static::CONFIG_DEFAULT_NAME . static::CONFIG_EXT));
            if (isset(static::$config[static::CONFIG_IMPORT_BLOCK])) {
                foreach ((array)static::$config[static::CONFIG_IMPORT_BLOCK] as $file) {
                    $file = (array)$file;
                    $config = (array)json_decode(file_get_contents(ROOT_DIR . static::CONFIG_PATH . $file[static::CONFIG_IMPORT_RES] . static::CONFIG_EXT));
                    static::$config = array_merge(static::$config, $config);
                }
                unset(static::$config[static::CONFIG_IMPORT_BLOCK]);
            }
        }

        $config = (isset(static::$config[$section])) ? static::$config[$section] : static::$config;
        return (is_object($config)) ? (array)$config : $config;
    }

    /**
     * Close method construct
     */
    private function __construct()
    {
    }

    /**
     * Close method clone
     *
     */
    private function __clone()
    {
    }

}