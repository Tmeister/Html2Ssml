<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class EmphasisTest extends TestCase
{

    /** @test */
    public function it_can_convert_em_to_ssml()
    {
        $html      = '<em>emphasis tag</em>';
        $expected  = '<emphasis>emphasis tag</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test */
    public function it_can_convert_b_to_ssml()
    {
        $html      = '<b>emphasis tag</b>';
        $expected  = '<emphasis>emphasis tag</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test */
    public function it_can_convert_strong_to_ssml()
    {
        $html      = '<strong>emphasis tag</strong>';
        $expected  = '<emphasis>emphasis tag</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test */
    public function it_can_convert_th_to_ssml()
    {
        $html      = '<th>emphasis tag</th>';
        $expected  = '<emphasis>emphasis tag</emphasis>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

}
