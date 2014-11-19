<?php

namespace Serptember\Tracker\Adapter;

use Zend\Http\Client,
    Serptember\Tracker\Exception;

abstract class AbstractAdaptor
{
    /**
     * Search engine's URL
     *
     * @var
     */
    protected $searchEngineUrl;

    /**
     * The site that we are searching for
     *
     * @var
     */
    protected $siteUrl;

    /**
     * The keywords we are searching for
     *
     * @var array
     */
    protected $keywords = array();

    /**
     * The page that the crawler is on
     *
     * @var
     */
    protected $currentPage = 0;

    /**
     * Max search position
     *
     * @var
     */
    protected $limit = 100;

    /**
     * Proxy servers used for searching
     *
     * @var
     */
    protected $proxy = array();

    /**
     * Well hold on to the debug log here
     *
     * @var
     */
    protected $debug = false;

    /**
     * Dont know if we need this here
     */
    public function __construct()
    {

    }

    /**
     * Set the search engine's URL which we will crawl
     *
     * @param $url String
     *
     * @throws Exception\InvalidArgumentException
     * @throws Exception\OutOfBoundsException
     */
    public function setSearchUrl($url)
    {
        if (!is_string($url)) {
            throw new Exception\InvalidArgumentException(
                'Expected parameter need to be string, ' . gettype($url)
                . ' provided instead.'
            );
        }

        if (stripos($url, '{k}') === false) {
            throw new Exception\OutOfBoundsException(
                'Missing keyword {k} parameter.'
            );
        }

        $this->searchEngineUrl = $url;
    }

    /**
     * @param $keyword
     */
    private function _crawl($keyword)
    {
        $config = array(
            'adapter' => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => array(
                CURLOPT_FOLLOWLOCATION => true
            ),
        );

        /**
         * todo: format the url before dispatching the request
         */
        $response = new Client($this->searchEngineUrl, $config);
    }
} 