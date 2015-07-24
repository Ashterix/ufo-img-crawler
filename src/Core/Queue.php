<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: Queue.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *  
 * Class - Queue
 * @description 
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 9:46
 */

namespace Core;


class Queue 
{
    /**
     * Urls for parsing
     * @var array
     */
    private $queue = [];

    /**
     * Processed urls
     * @var array
     */
    private $complete = [];

    /**
     * Add url to stack processed links and delete from queueObject
     * @param string $url
     * @param int $countImg
     * @param int $time
     * @return self
     */
    public function setToComplete($url, $countImg, $time)
    {
        $this->complete[md5($url)] = [
            'url' => $url,
            'count_img' => $countImg,
            'time' => $time
        ];
        unset($this->queue[md5($url)]);
        return $this;
    }

    /**
     * @return array
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Add url to queueObject if complete stack haven't this url
     * @param string $url
     * @return self
     */
    public function setToQueue($url)
    {
        if (!isset($this->getComplete()[md5($url)])) {
            $this->queue[md5($url)] = $url;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getQueue()
    {
        return $this->queue;
    }

}