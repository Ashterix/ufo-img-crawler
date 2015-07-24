<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: Saver.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - Saver
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 19:35
 */

namespace Crawler;


use Core\Config;
use Core\HtmlCreators\TableCreator;
use UFOFileSystem\File;

class Saver
{
    const FILENAME_PREFIX = 'report_';

    /**
     * @var array
     */
    private $resultArray = [];

    /**
     * @param $resultArray
     */
    public function __construct($resultArray)
    {
        $this->resultArray = $resultArray;
        usort($this->resultArray, array(__CLASS__, 'sortByCountImage'));
    }

    /**
     * Save result to file
     */
    public function save()
    {
        $table = new TableCreator($this->resultArray);

        $file = new File(ROOT_DIR . Config::get('path_for_save_report') . self::FILENAME_PREFIX . date('d.m.Y') . '.html');
        $file->setContent($table->header('22')->get())->save();
    }

    /**
     * Sort multiple array by count img
     *
     * @param $v1
     * @param $v2
     * @return int
     */
    private static function sortByCountImage($v1, $v2)
    {
        $result = 0;
        if ($v1["count_img"] != $v2["count_img"]) {
            $result = ($v1["count_img"] < $v2["count_img"]) ? -1 : 1;
        }
        return $result;
    }

}