<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class HeadersTest extends TestCase
{
    /** @test */
    public function it_can_convert_headings_to_ssml()
    {
        $html      = file_get_contents(__DIR__ . '/data/test.html');
        $html2ssml = new Html2Ssml($html);
        $html2ssml->getSsml();
        $this->assertTrue(true);
    }
}
