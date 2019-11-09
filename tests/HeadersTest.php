<?php


namespace Tmeister\Ssml\Tests;


use Exception;
use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class HeadersTest extends TestCase
{
    /** @test
     * @throws Exception
     */
    public function it_can_convert_h1_to_ssml()
    {
        $html      = '<h1>Heading</h1>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_h2_to_ssml()
    {
        $html      = '<h2>Heading</h2>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_h3_to_ssml()
    {
        $html      = '<h3>Heading</h3>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_h4_to_ssml()
    {
        $html      = '<h4>Heading</h4>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_h5_to_ssml()
    {
        $html      = '<h5>Heading</h5>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_h6_to_ssml()
    {
        $html      = '<h6>Heading</h6>';
        $expected  = '<emphasis>Heading</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws Exception
     */
    public function it_can_convert_multiple_headings_to_ssml()
    {
        $html      = <<<EOF
<h1>Heading</h1>
<h2>Subheading</h2>
EOF;

        $expected  = <<<EOF
<emphasis>Heading</emphasis>
 <emphasis>Subheading</emphasis>
EOF;

        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }
}
