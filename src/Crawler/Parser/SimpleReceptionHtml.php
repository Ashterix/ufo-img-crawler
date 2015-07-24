<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: SimpleReceptionHtml.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *  
 * Class - SimpleReceptionHtml
 * @description 
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 9:29
 */

namespace Crawler\Parser;


use Core\ReceptionHtml;

class SimpleReceptionHtml extends ReceptionHtml
{

    /**
     * Get content via the link
     *
     * @return mixed
     */
    protected function getSiteContent()
    {
        $this->setContent(file_get_contents($this->getUrl()));
    }
}