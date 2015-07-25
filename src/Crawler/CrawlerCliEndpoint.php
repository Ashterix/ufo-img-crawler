<?php
/**
 * ufo-img-crawler.loc
 *
 * @file: CrawlerCliEndpoint.php
 * @author Alex Maystrenko <ashterix69@gmail.com>
 *
 * Class - CrawlerCliEndpoint
 * @description
 *
 * Created by JetBrains PhpStorm.
 * Date: 24.07.2015
 * Time: 1:16
 */

namespace Crawler;


use Control\ControlTime;
use Core\CliEndpoint;
use Core\CliReturnCode;
use Core\Config;
use Core\Queue;

class CrawlerCliEndpoint extends CliEndpoint
{
    /**
     * Stack of methods for run in child class
     *
     * @return mixed
     */
    protected function afterConstruct()
    {
        $this->checkHelp();
        $this->checkUrl();
    }

    /**
     * Check help attribute in cmd
     */
    protected function checkHelp()
    {
        if (isset($this->options['h']) || isset($this->options['help'])) {
            $this->runHelp();
            CliReturnCode::success();
        }
    }

    /**
     * Show help message
     */
    protected function runHelp()
    {
        $help = file_get_contents(ROOT_DIR . Config::get('help_file'));
        echo $help . PHP_EOL;
    }

    /**
     * Check url attribute in cmd
     */
    protected function checkUrl()
    {
        $url = '';
        if (isset($this->options['u'])) {
            $url = $this->options['u'];
        } elseif (isset($this->options['url'])) {
            $url = $this->options['url'];
        } else {
            $this->runHelp();
            CliReturnCode::fatal();
        }

        $this->runUrlCrawler($url);
    }

    /**
     * Run crawler
     *
     * @param $url
     */
    protected function runUrlCrawler($url)
    {
        $this->write('Start crawler');
        $queue = new Queue();
        ControlTime::init();
        $this->write('WAIT', false, false);
        do {
            $urlForCrawler = ($queue->getQueue()) ? current($queue->getQueue()) : $url;
            $facade = new ParserHtmlFacade($urlForCrawler);
            $facade->setQueueObject($queue)->run();
            $this->write(' .', false, false);
        } while (count($queue->getQueue()) > 0);
        $this->write('', true, false);
        $this->write("Indexed " . count($queue->getComplete()) . " pages");
        $saver = new Saver($queue->getComplete());
        $this->write("Save to file");
        $saver->save();
        $this->write('Finish crawler');
        CliReturnCode::success();
    }

    /**
     * Print message
     *
     * @param string $message
     * @param bool $newline
     * @param bool $time
     */
    public function write($message, $newline = true, $time = true)
    {
        echo ($time ? date('H:i:s') . " - " : '') . $message . ($newline ? PHP_EOL : '');
    }
}