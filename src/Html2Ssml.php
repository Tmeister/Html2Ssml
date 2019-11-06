<?php

namespace Tmeister\Ssml;

use mysql_xdevapi\Exception;

class Html2Ssml
{
    /**
     * Contains the HTML content to convert
     *
     * @var string
     */
    protected $html;

    /**
     * Contains the converted, formatted ssml
     *
     * @var string
     */
    protected $ssml;

    /**
     * Flag to know if the content in the $html variable has been converted
     *
     * @var boolean
     * @see $html, $text
     */
    protected $converted;

    /**
     * Html2Ssml constructor
     *
     * @param string $html
     */
    public function __construct($html = '')
    {
        $this->html = $html;
    }

    /**
     * Get the Html source
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set the Html source
     *
     * @param $html
     */
    public function setHtml($html)
    {
        $this->html = $html;
    }

    /**
     * Return the Ssml converted from Html
     *
     * @return string
     */
    public function getSsml()
    {
        if ( ! $this->converted) {
            $this->convert();
        }

        return $this->ssml;
    }

    protected function convert()
    {

    }

    protected function parseHtml(){
        if(empty($this->html)){
            throw new \Exception();
        }
    }


}
