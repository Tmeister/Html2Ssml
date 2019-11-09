<?php

namespace Tmeister\Ssml;

use Exception;

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
     * @var string
     */
    protected $htmlFuncFlags;

    /**
     * List of preg* regular expression patterns to search for,
     * used in conjunction with $replace.
     *
     * @type array
     * @see $replace
     */
    protected $search = [
        "/\r/",                                           // Non-legal carriage return
        "/[\n\t]+/",                                      // Newlines and tabs
        '/<head\b[^>]*>.*?<\/head>/i',                    // <head>
        '/<script\b[^>]*>.*?<\/script>/i',                // <script>s -- which strip_tags supposedly has problems with
        '/<style\b[^>]*>.*?<\/style>/i',                  // <style>s -- which strip_tags supposedly has problems with
        '/<i\b[^>]*>(.*?)<\/i>/i',                        // <i>
        '/<em\b[^>]*>(.*?)<\/em>/i',                      // <em>
        '/(<ul\b[^>]*>|<\/ul>)/i',                        // <ul> and </ul>
        '/(<ol\b[^>]*>|<\/ol>)/i',                        // <ol> and </ol>
        '/(<dl\b[^>]*>|<\/dl>)/i',                        // <dl> and </dl>
        '/<li\b[^>]*>(.*?)<\/li>/i',                      // <li> and </li>
        '/<dd\b[^>]*>(.*?)<\/dd>/i',                      // <dd> and </dd>
        '/<dt\b[^>]*>(.*?)<\/dt>/i',                      // <dt> and </dt>
        '/<li\b[^>]*>/i',                                 // <li>
        '/<hr\b[^>]*>/i',                                 // <hr>
        '/<div\b[^>]*>/i',                                // <div>
        '/(<table\b[^>]*>|<\/table>)/i',                  // <table> and </table>
        '/(<tr\b[^>]*>|<\/tr>)/i',                        // <tr> and </tr>
        '/<td\b[^>]*>(.*?)<\/td>/i',                      // <td> and </td>
        '/<span class="_html2text_ignore">.+?<\/span>/i', // <span class="_html2text_ignore">...</span>
        '/<(img)\b[^>]*alt=\"([^>"]+)\"[^>]*>/i',         // <img> with alt tag
    ];

    /**
     * List of pattern replacements corresponding to patterns searched.
     *
     * @type array
     * @see $search
     */
    protected $replace = [
        '',                                  // Non-legal carriage return
        ' ',                                 // Newlines and tabs
        '',                                  // <head>
        '',                                  // <script>s -- which strip_tags supposedly has problems with
        '',                                  // <style>s -- which strip_tags supposedly has problems with
        '\\1',                               // <i>
        '[emphasis]\\1[/emphasis]',          // <em>
        "",                                  // <ul> and </ul>
        "",                                  // <ol> and </ol>
        "",                                  // <dl> and </dl>
        "[s]\\1[/s]",                        // <li> and </li>
        "\\1",                               // <dd> and </dd>
        "\\1",                               // <dt> and </dt>
        "",                                  // <li>
        "",                                  // <hr>
        "",                                  // <div>
        "",                                  // <table> and </table>
        "",                                  // <tr> and </tr>
        "\\1",                               // <td> and </td>
        "",                                  // <span class="_html2text_ignore">...</span>
        '[\\2]',                             // <img> with alt tag
    ];

    /**
     * List of preg* regular expression patterns to search for,
     * used in conjunction with $entReplace.
     *
     * @type array
     * @see $entReplace
     */
    protected $entSearch = [
        '/&#153;/i',                                     // TM symbol in win-1252
        '/&#151;/i',                                     // m-dash in win-1252
        '/&(amp|#38);/i',                                // Ampersand: see converter()
        '/[ ]{2,}/',                                     // Runs of spaces, post-handling
        '/&#39;/i',                                      // The apostrophe symbol
    ];

    /**
     * List of pattern replacements corresponding to patterns searched.
     *
     * @type array
     * @see $entSearch
     */
    protected $entReplace = [
        '™',         // TM symbol
        '—',         // m-dash
        '|+|amp|+|', // Ampersand: see converter()
        ' ',         // Runs of spaces, post-handling
        '\'',        // Apostrophe
    ];

    /**
     * List of preg* regular expression patterns to search for
     * and replace using callback function.
     *
     * @type array
     */
    protected $callbackSearch = [
        '/<(h)[123456]( [^>]*)?>(.*?)<\/h[123456]>/i',           // h1 - h6
        '/[ ]*<(p)( [^>]*)?>(.*?)<\/p>[ ]*/si',                  // <p> with surrounding whitespace.
        '/<(br)[^>]*>[ ]*/i',                                    // <br> with leading whitespace after the newline.
        '/<(b)( [^>]*)?>(.*?)<\/b>/i',                           // <b>
        '/<(strong)( [^>]*)?>(.*?)<\/strong>/i',                 // <strong>
        '/<(th)( [^>]*)?>(.*?)<\/th>/i',                         // <th> and </th>
        '/<(a) [^>]*href=("|\')([^"\']+)\2([^>]*)>(.*?)<\/a>/i'  // <a href="">
    ];

    /**
     * List of preg* regular expression patterns to search for in PRE body,
     * used in conjunction with $preReplace.
     *
     * @type array
     * @see $preReplace
     */
    protected $preSearch = [
        "/\n/",
        "/\t/",
        '/ /',
        '/<pre[^>]*>/',
        '/<\/pre>/'
    ];

    /**
     * List of pattern replacements corresponding to patterns searched for PRE body.
     *
     * @type array
     * @see $preSearch
     */
    protected $preReplace = [
        '<br>',
        '&nbsp;&nbsp;&nbsp;&nbsp;',
        '&nbsp;',
        '',
        '',
    ];

    /**
     * List of preg* regular expression patterns to search for,
     * used in conjunction with $replace.
     *
     * @type array
     */
    protected $ssmlSearch = [
        '/(\[)emphasis(\])/m',
        '/(\[)\/emphasis(\])/m',
        '/(\[)s(\])/m',
        '/(\[)\/s(\])/m'
    ];

    /**
     * List of preg* regular expression patterns to search for,
     * used in conjunction with $replace.
     *
     * @type array
     */
    protected $ssmlReplace = [
        "<emphasis>",
        "</emphasis>",
        "<s>",
        "</s>",
    ];

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
        $this->html      = $html;
        $this->converted = false;
    }

    /**
     * Return the Ssml converted from Html
     *
     * @return string
     * @throws Exception
     */
    public function getSsml()
    {
        if ( ! $this->converted) {
            $this->convert();
        }

        return $this->ssml;
    }

    /**
     *
     * @throws Exception
     */
    protected function convert()
    {
        $origEncoding = mb_internal_encoding();
        mb_internal_encoding('UTF-8');
        $this->parseHtml();
        $this->doSsmlTags();
        mb_internal_encoding($origEncoding);
    }

    /**
     * @throws Exception
     */
    protected function parseHtml()
    {
        if (empty($this->html)) {
            throw new Exception();
        }

        $this->doConversion($this->html);
    }

    /**
     * @param $text
     */
    protected function doConversion($text)
    {
        $text = preg_replace($this->search, $this->replace, $text);
        $text = preg_replace_callback($this->callbackSearch, [$this, 'pregCallback'], $text);
        $text = strip_tags($text);
        $text = preg_replace($this->entSearch, $this->entReplace, $text);
        $text = html_entity_decode($text, $this->htmlFuncFlags, 'UTF-8');
        // Remove unknown/unhandled entities (this cannot be done in search-and-replace block)
        $text = preg_replace('/&([a-zA-Z0-9]{2,6}|#[0-9]{2,4});/', '', $text);

        // Convert "|+|amp|+|" into "and", need to be done after handling of unknown entities
        // This properly handles situation of "&amp;quot;" in input string
        $text = str_replace('|+|amp|+|', 'and', $text);

        // Normalise empty lines
        $text = preg_replace("/\n\s+\n/", "\n\n", $text);
        $text = preg_replace("/[\n]{3,}/", "\n\n", $text);

        // remove leading empty lines (can be produced by eg. P tag on the beginning)
        $this->ssml = trim($text);
    }

    /**
     * Callback function for preg_replace_callback use.
     *
     * @param array $matches PREG matches
     *
     * @return string
     */
    protected function pregCallback($matches)
    {
        switch (mb_strtolower($matches[1])) {
            case 'p':
                $para = str_replace("\n", "", $matches[3]);
                $para = trim($para);

                return "[s]" . $para . "[/s]\n";
            case 'br':
                return "";
            case 'b':
            case 'strong':
            case 'th':
            case 'h':
                return "[emphasis]" . $matches[3] . "[/emphasis]\n";
            case 'a':
                return $matches[5];
        }

        return '';
    }

    /**
     *
     */
    protected function doSsmlTags()
    {
        $ssml = preg_replace($this->ssmlSearch, $this->ssmlReplace, $this->ssml);

        $this->ssml = $ssml;
    }
}
