<?php

namespace ElementTree;

class ElementTreeAttributeTest extends \PHPUnit\Framework\TestCase
{
    public function setup()
    {
        $this->attr = new \ElementTree\ElementTreeAttribute('foo', 'bar');
    }

    /**
     * @test
     */
    public function hasName()
    {
        $this->assertEquals('foo', $this->attr->getName());
    }

    /**
     * @test
     */
    public function hasValue()
    {
        $this->assertEquals('bar', $this->attr->getValue());
    }

    /**
     * @test
     */
    public function valueCanBeChanged()
    {
        $this->attr->setValue('xyz');
        $this->assertEquals('xyz', $this->attr->getValue());
    }

    /**
     * @test
     */
    public function toStringDefaultIsValueDoubleQuoted()
    {
        $this->assertEquals('foo="bar"', $this->attr->toString());
    }

    /**
     * @test
     */
    public function valueCanBeSingleQuoted()
    {
        $this->attr->singleQuotes();
        $this->assertEquals("foo='bar'", $this->attr->toString());
    }

    /**
     * @test
     */
    public function valueCanBeUnquoted()
    {
        $this->attr->noQuotes();
        $this->assertEquals('foo=bar', $this->attr->toString());
    }

    /**
     * @test
     */
    public function valueCanBeSetBackToDouble()
    {
        $this->attr->noQuotes();
        $this->assertEquals('foo=bar', $this->attr->toString());
        $this->attr->doubleQuotes();
        $this->assertEquals('foo="bar"', $this->attr->toString());
    }

    /**
     * @test
     */
    public function hasNoParentByItself()
    {
        $this->assertEquals(false, $this->attr->hasParent());
    }

    /**
     * @test
     */
    public function hasNoOwnerTreeByItself()
    {
        $this->assertEquals(false, $this->attr->getOwnerTree());
    }

    /**
     * @test
     */
    public function hasNoChildren()
    {
        $this->assertEquals(false, $this->attr->hasChildren());
    }
}
