<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: ParserHtmlFacade.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - ParserHtmlFacade
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 12:21
 */

namespace Crawler;


use Control\ControlTime;
use Core\Parser;
use Core\Queue;
use Core\ReceptionHtml;
use Crawler\Parser\SimpleReceptionHtml;

class ParserHtmlFacade
{

    /**
     * @var ReceptionHtml|null
     */
    private $receptionObject = null;

    /**
     * @var Queue|null
     */
    private $queueObject = null;

    /**
     * @var string|null
     */
    private $url = null;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $this->cutLastSlash($url);
        $this->url = $this->addHttpToUrl($this->url);
        $this->setReceptionObject();
    }

    /**
     * Run crawler process
     */
    public function run()
    {
        ControlTime::addWayPoint();
        $this->getQueueObject()->setToQueue($this->url);
        $parseUrl = parse_url($this->url);
        $host = $parseUrl['scheme'] . '://' . $parseUrl['host'];

        $parser = new Parser($this->getReceptionObject()->getContent());

        foreach ($parser->setHost($host)->getLinks() as $link) {
            $link = $this->cutLastSlash($link);
            if (mb_strpos($link, '//') === 0) continue;
            if (mb_strpos($link, $host) === false) {
                $link = $host . $link;
            }
            $this->getQueueObject()->setToQueue($link);
        }

        ControlTime::addWayPoint(md5($this->url));
        $this->setToComplete($parser->countAllImgTags());
    }

    /**
     * Set data to complete stack
     *
     * @param $count
     */
    private function setToComplete($count)
    {
        $this->getQueueObject()->setToComplete($this->url, $count, ControlTime::getPrevData()['from_prev']);
    }

    /**
     * Cut last slash from url
     *
     * @param string $url
     * @return string
     */
    private function cutLastSlash($url)
    {
        return preg_replace("%/$%", "", $url);
    }

    /**
     * Add http to url if not have
     *
     * @param string $url
     * @return string
     */
    private function addHttpToUrl($url)
    {
        if (mb_stripos($url, 'http') === false) {
            $url = 'http://' . $url;
        }
        return $url;
    }

    /**
     * @return ReceptionHtml
     */
    public function getReceptionObject()
    {
        return $this->receptionObject;
    }

    /**
     * @return self
     */
    public function setReceptionObject()
    {
        $this->receptionObject = new SimpleReceptionHtml($this->url);
        return $this;
    }

    /**
     * @return Queue
     */
    public function getQueueObject()
    {
        return $this->queueObject;
    }

    /**
     * @param Queue $queue
     * @return self
     */
    public function setQueueObject(Queue $queue)
    {
        $this->queueObject = $queue;
        return $this;
    }
}