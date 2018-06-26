<?php

namespace ElementTree;

class TextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function hasValue()
    {
        $text = new \ElementTree\Text('foo');

        $this->assertEquals('foo', $text->getValue());
    }

    /**
     * @test
     */
    public function returnsValueForXmlUse()
    {
        $text = new \ElementTree\Text('foo');

        $this->assertEquals('foo', $text->toString());
    }

    /**
     * @test
     */
    public function hasNoChildren()
    {
        $text = new \ElementTree\Text('foo');

        $this->assertFalse($text->hasChildren());
    }
}
