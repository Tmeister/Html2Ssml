<?php


namespace Tmeister\Ssml\Tests;


use PHPUnit\Framework\TestCase;
use Tmeister\Ssml\Html2Ssml;

class ParagraphTest extends TestCase
{

    /** @test
     * @throws \Exception
     */
    public function it_can_convert_paragraphs_to_ssml()
    {
        $html      = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>';
        $expected  = '<s>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</s>';
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }

    /** @test
     * @throws \Exception
     */
    public function it_can_convert_multiple_paragraphs_to_ssml()
    {
        $html = <<<EOF
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ligula tellus, rhoncus at ultrices in, scelerisque sed ipsum. Praesent et justo mauris.</p>
<p>Pellentesque dictum tincidunt urna non sodales. Praesent volutpat ipsum quis arcu placerat egestas. In aliquet velit urna, id placerat erat commodo eget. Duis nibh odio, euismod quis fringilla at, ultricies quis sapien.</p>
<p>Proin vel nibh metus. Quisque suscipit accumsan nulla eu suscipit. Mauris at erat eu lorem ultrices fringilla. Pellentesque metus nibh, sollicitudin nec nunc et, finibus ornare odio. Nunc sed sollicitudin nulla, non aliquet nibh.</p>
EOF;

        $expected  = <<<EOF
<s>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam ligula tellus, rhoncus at ultrices in, scelerisque sed ipsum. Praesent et justo mauris.</s>
<s>Pellentesque dictum tincidunt urna non sodales. Praesent volutpat ipsum quis arcu placerat egestas. In aliquet velit urna, id placerat erat commodo eget. Duis nibh odio, euismod quis fringilla at, ultricies quis sapien.</s>
<s>Proin vel nibh metus. Quisque suscipit accumsan nulla eu suscipit. Mauris at erat eu lorem ultrices fringilla. Pellentesque metus nibh, sollicitudin nec nunc et, finibus ornare odio. Nunc sed sollicitudin nulla, non aliquet nibh.</s>
EOF;
        $html2ssml = new Html2Ssml($html);
        $ssml      = $html2ssml->getSsml();
        $this->assertEquals($expected, $ssml);
    }
}
