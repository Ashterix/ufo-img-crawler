<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: Parser.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - Parser
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 15:06
 */

namespace Core;


class Parser
{
    /**
     * @var string
     */
    private $content = '';

    /**
     * @var string
     */
    private $host = '';

    /**
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Getting all the links from the page
     *
     * @return mixed
     */
    public function getLinks()
    {
        preg_match_all('%<a [^>]*?href=[\'"]((' . $this->host . ')?/.[^\s]*?)(?<!jpg|jpeg|gif|png)[\'"]%is', $this->content, $matches);
        return $matches[1];
    }

    /**
     * Counting all the pictures on the page
     */
    public function countAllImgTags()
    {
        return preg_match_all('%<img%is', $this->content);
    }

    /**
     * @param string $host
     * @return self
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }
}