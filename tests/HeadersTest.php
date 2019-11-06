<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class HeadersTest extends TestCase
{
     /** @test */
     public function it_can_convert_headings_to_ssml()
     {
         $html =<<<EOT
<h1>A header title (äöüèéилčλ)</h1>
<p>just a p tag</p>
EOT;
         $expected =<<<EOT
A header title (äöüèéилčλ)

just a p tag

EOT;
         $html2ssml = new Html2Ssml($html);
         $html2ssml->getSsml();
         $this->assertEquals($html, $html2ssml->getHtml());

     }
}
