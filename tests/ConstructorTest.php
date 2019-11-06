<?php

namespace Tmeister\Ssml\Tests;

use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class ConstructorTest extends TestCase
{
    /** @test */
    public function it_can_get_a_main_class_instance_with_no_arguments()
    {
        $html2ssml = new Html2Ssml();
        $this->assertInstanceOf(Html2Ssml::class, $html2ssml);
    }

    /** @test */
    public function it_can_get_a_main_class_instance_with_arguments()
    {
        $rawHtml = '<h1>This is a title</h1>';
        $html2ssml    = new Html2Ssml($rawHtml);
        $this->assertInstanceOf(Html2Ssml::class, $html2ssml);
    }

    /** @test */
    public function constructor_can_accept_a_html_content()
    {
        $rawHtml       = '<h1>This is a title</h1>';
        $html2ssml          = new Html2Ssml($rawHtml);
        $processedHtml = $html2ssml->getHtml();
        $this->assertEquals($rawHtml, $processedHtml);
    }

    /** @test */
    public function it_can_set_the_html_content()
    {
        $rawHtml = '<h1>This is a title</h1>';
        $html2ssml    = new Html2Ssml();
        $html2ssml->setHtml($rawHtml);
        $this->assertEquals($rawHtml, $html2ssml->getHtml());
    }

    /** @test */
    public function it_can_override_the_html_content()
    {
        $rawHtml = '<h1>This is a title</h1>';
        $html2ssml    = new Html2Ssml();
        $html2ssml->setHtml($rawHtml);
        $this->assertEquals($rawHtml, $html2ssml->getHtml());

        $newRawHtml = '<h2>This is a subtitle</h2>';
        $html2ssml->setHtml($newRawHtml);
        $this->assertEquals($newRawHtml, $html2ssml->getHtml());
    }
}
