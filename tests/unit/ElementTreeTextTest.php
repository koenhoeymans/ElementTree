<?php

namespace ElementTree;

class ElementTreeTextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function hasValue()
    {
        $text = new \ElementTree\ElementTreeText('foo');

        $this->assertEquals('foo', $text->getValue());
    }

    /**
     * @test
     */
    public function returnsValueForXmlUse()
    {
        $text = new \ElementTree\ElementTreeText('foo');

        $this->assertEquals('foo', $text->toString());
    }

    /**
     * @test
     */
    public function hasNoChildren()
    {
        $text = new \ElementTree\ElementTreeText('foo');

        $this->assertFalse($text->hasChildren());
    }
}
