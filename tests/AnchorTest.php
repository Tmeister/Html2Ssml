<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class AnchorTest extends TestCase
{

     /** @test */
     public function it_can_convert_multiple_links_to_ssml()
     {
         $html      = '<a href="https://google.com">Google</a>';
         $expected  = 'Google';
         $html2ssml = new Html2Ssml($html);
         $ssml      = $html2ssml->getSsml();
         $this->assertEquals($expected, $ssml);
     }

    /** @test */
    public function it_can_convert_multiple_links_with_attributes_to_ssml()
    {
        $html      = '<a href="https://google.com" target="_blank" class="some class" aria-hidden="true">Google</a>';
        $expected  = 'Google';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }
}
