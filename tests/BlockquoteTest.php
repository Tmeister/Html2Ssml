<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class BlockquoteTest extends TestCase
{

    /** @test */
    public function it_can_convert_blockquote_to_ssml()
    {
        $html = file_get_contents(__DIR__ . '/data/test.html');
        $expected  = <<<EOF
<emphasis>Hello</emphasis>
 <s>Lately, as Developers, WordPress Power Users or final user we are used to using some Page Builder.</s>
<s>There are tens of Page Builders out there, some bad as Visual Composer some good as Beaver Builder.</s>
<s>Now for a new project that I am starting working on and for as requirement needs a page builder, I did research to know what’s new on this topic.</s>
<s>I found this “relative” new Page Builder called Elementor, and for my surprise, the plugin really nailed it about the UI and UX, is easy to use, it does not fill the content with a shortcodes nightmare, is fast, intuitive and easy to use.</s>
<s>For the next couple of months, I’ll be fully working with Elementor not just using the UI and the default modules, I’ll create custom modules for the project, and I’ll like to document the process.</s>
<s>For now here is a resources list to start and get involved with Elementor.</s>
<emphasis>Elementor Free and Pro Plugins</emphasis>
<s>Elementor Page Builder (Free)</s><s>Elementor Pro (Paid)</s><emphasis>Themes that works with Elementor</emphasis>
<s>GeneratePress</s><s>Elegant Marketplace</s><s>Base Theme by SitePoint</s><emphasis>Tutorials, Tips, and Tricks</emphasis>
<s>Elementor’s Youtube Channel</s><s>WPTuts Elementor Youtube Tutorials Playlist</s><s>Elementor Tutorials at SniffleValve.com</s><s>WP Sculptor’s 3.5 Hour Long Elementor Tutorial (Youtube)</s><s>Part 1: WP Sculptor’s Elementor Pro Tutorial (Youtube)</s><s>CSS to Offset Sticky Header For Anchor Links by Joel Eade</s><emphasis>Widgets and Other Addons to Elementor</emphasis>
<s>SiteOrigin Widgets Bundle</s><s>Page Templater by WPDevHQ</s><s>Addon Widgets by WPDevHQ</s><s>Nav Menu Addon by WPDevHQ</s><s>Anywhere Elementor by WebTechStreet</s><s>Elementor Addon Elements by WebTechStreet</s><s>WP Pro Counter by WooRocks</s><s>Magic Content by WooRocks</s><s>SJ Elementor Addon by Sandesh</s> <s>Highlights from today’s <emphasis>Newlyhired Game</emphasis>
:</s>
<s><emphasis>Sean:</emphasis>
 What came first, Blake’s first <emphasis>Chief Architect position</emphasis> or Blake’s first <emphasis>girlfriend</emphasis>?</s>
 <s><emphasis>Sean:</emphasis>
 Devin, Bryan spent almost five years of his life slaving away for this vampire squid wrapped around the face of humanity…<emphasis>Devin:</emphasis>
 Goldman Sachs?<emphasis>Sean:</emphasis>
 Correct!</s>
 <s><emphasis>Sean:</emphasis>
 What was the name of the girl Zhu took to prom three months ago?<emphasis>John:</emphasis>
 What?<emphasis>Derek (from the audience):</emphasis>
 Destiny!<emphasis>Zhu:</emphasis>
 Her name is Jolene. She’s nice. I like her.</s>
<s>I think the audience is winning.  - Derek</s>
 There is anything missing? Please add your resource. in the comments!
EOF;

        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }
}
