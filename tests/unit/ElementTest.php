<?php

namespace ElementTree;

class ElementTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function elementsHaveName()
    {
        $element = new \ElementTree\Element('a');

        $this->assertEquals('a', $element->getName());
    }

    /**
     * @test
     */
    public function elementsCanHaveAttributes()
    {
        $element = new \ElementTree\Element('a');
        $attr = $element->setAttribute('name', 'value');

        $this->assertEquals('value', $element->getAttributeValue('name'));
        $this->assertTrue($attr instanceof \ElementTree\Attribute);
    }

    /**
     * @test
     */
    public function canAskElementsIfTheyHaveAttributeWithName()
    {
        $element = new \ElementTree\Element('a');
        $attr = $element->setAttribute('name', 'value');

        $this->assertFalse($element->hasAttribute('foo'));
        $this->assertTrue($element->hasAttribute('name'));
    }

    /**
     * @test
     */
    public function attributesCanBeRemoved()
    {
        $element = new \ElementTree\Element('b');
        $attr = $element->setAttribute('foo', 'bar');
        $this->assertEquals(array($attr), $element->getAttributes());

        $element->removeAttribute('foo');
        $this->assertEquals(array(), $element->getAttributes());
    }

    /**
     * @test
     */
    public function providesListOfAttributes()
    {
        $element = new \ElementTree\Element('a');
        $class = $element->setAttribute('class', 'foo');
        $id = $element->setAttribute('id', 'bar');

        $this->assertEquals(array($class, $id), $element->getAttributes());
    }

    /**
     * @test
     */
    public function elementsCanHaveElements()
    {
        $a = new \ElementTree\Element('a');
        $b = new \ElementTree\Element('b');
        $a->append($b);

        $this->assertEquals(array($b), $a->getChildren());
    }

    /**
     * @test
     */
    public function elementsCanHaveText()
    {
        $a = new \ElementTree\Element('a');
        $text = new \ElementTree\Text('text');
        $a->append($text);

        $this->assertEquals(array($text), $a->getChildren());
    }

    /**
     * @test
     */
    public function isParentOfAppendedElement()
    {
        $parent = new \ElementTree\Element('parent');
        $child = new \ElementTree\Element('child');
        $parent->append($child);

        $this->assertEquals($parent, $child->getParent());
    }

    /**
     * @test
     */
    public function isParentOfAttribute()
    {
        $parent = new \ElementTree\Element('parent');
        $attr = $parent->setAttribute('child', 'true');

        $this->assertEquals($parent, $attr->getParent());
    }

    /**
     * @test
     */
    public function isNotOwnerTreeOfAppendedElement()
    {
        $parent = new \ElementTree\Element('parent');
        $child = new \ElementTree\Element('child');
        $parent->append($child);

        $this->assertNull($child->getOwnerTree());
    }

    /**
     * @test
     */
    public function isNotOwnerTreeOfAppendedAttribute()
    {
        $parent = new \ElementTree\Element('parent');
        $attr = $parent->setAttribute('child', 'true');

        $this->assertEquals(null, $attr->getOwnerTree());
    }

    /**
     * @test
     */
    public function setsOwnerTreeOfAppendedElement()
    {
        $elementTree = new \ElementTree\ElementTree();
        $parent = new \ElementTree\Element('parent');
        $child = new \ElementTree\Element('child');
        $parent->append($child);
        $elementTree->append($parent);

        $this->assertEquals($elementTree, $child->getOwnerTree());
    }

    /**
     * @test
     */
    public function setsOwnerTreeOfAttribute()
    {
        $elementTree = new \ElementTree\ElementTree();
        $parent = new \ElementTree\Element('parent');
        $attr = $parent->setAttribute('child', 'true');
        $elementTree->append($parent);

        $this->assertEquals($elementTree, $attr->getOwnerTree());
    }

    /**
     * @test
     */
    public function wrapsChildXmlInOwnTags()
    {
        $a = new \ElementTree\Element('a');
        $b = new \ElementTree\Element('b');
        $a->append($b);

        $this->assertEquals('<a><b /></a>', $a->toString());
    }

    /**
     * @test
     */
    public function attributesAreInXmlStyleOutput()
    {
        $a = new \ElementTree\Element('a');
        $a->setAttribute('name', 'value');

        $this->assertEquals('<a name="value" />', $a->toString());
    }
}
