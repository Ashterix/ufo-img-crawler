<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: ReceptionHtml.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *  
 * Class - ReceptionHtml
 * @description 
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 9:16
 */

namespace Core;


abstract class ReceptionHtml
{
    /**
     * Link for the request
     * @var string
     */
    protected $url;

    /**
     * Content received via the link
     * @var string
     */
    protected $content;

    /**
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->getSiteContent();
    }

    /**
     * Get content via the link
     *
     * @return mixed
     */
    abstract protected function getSiteContent();

    /**
     * Setter for $content
     *
     * @param $content
     * @return $this
     */
    protected function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Getter for $content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Getter for $url
     *
     * @return mixed
     */
    protected function getUrl()
    {
        return $this->url;
    }

}