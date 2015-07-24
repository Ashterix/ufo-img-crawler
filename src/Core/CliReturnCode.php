<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: CliReturnCode.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *  
 * Class - CliReturnCode
 * @description 
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 1:27
 */

namespace Core;


class CliReturnCode
{
    const CODE_SUCCESS = 0;
    const CODE_WARNING = 1;
    const CODE_FATAL = 2;

    /**
     * Exit with code
     *
     * @param int|string $code
     */
    public static function returnCode($code = 0)
    {
        exit($code);
    }

    /**
     * Exit with code success
     */
    public static function success()
    {
        static::returnCode(static::CODE_SUCCESS);
    }

    /**
     * Exit with code warning
     */
    public static function warning()
    {
        static::returnCode(static::CODE_WARNING);
    }

    /**
     * Exit with code fatal
     */
    public static function fatal()
    {
        static::returnCode(static::CODE_FATAL);
    }

}