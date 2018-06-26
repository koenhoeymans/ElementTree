<?php

namespace ElementTree;

class ElementTreeTest extends \PHPUnit\Framework\TestCase
{
    public function setup()
    {
        $this->tree = new \ElementTree\ElementTree();
    }

    /**
     * @test
     */
    public function createsElement()
    {
        $this->assertTrue(
            $this->tree->createElement('foo') instanceof \ElementTree\Element
        );
    }

    /**
     * @test
     */
    public function createsText()
    {
        $this->assertTrue(
            $this->tree->createText('foo') instanceof \ElementTree\Text
        );
    }

    /**
     * @test
     */
    public function createsComment()
    {
        $this->assertTrue(
            $this->tree->createComment('foo') instanceof \ElementTree\Comment
        );
    }

    /**
     * @test
     */
    public function isParentOfAppended()
    {
        $element = new \ElementTree\Element('a');
        $this->tree->append($element);

        $this->assertEquals($this->tree, $element->getParent());
    }

    /**
     * @test
     */
    public function isNotOwnerTreeOfCreatedComponent()
    {
        $element = $this->tree->createElement('a');

        $this->assertNull($element->getOwnerTree());
    }

    /**
     * @test
     */
    public function isOwnerTreeOfItself()
    {
        $this->assertEquals($this->tree, $this->tree->getOwnerTree());
    }

    /**
     * @test
     */
    public function addsOwnerTreeToAppendedElement()
    {
        $element = new \ElementTree\Element('p');
        $this->tree->append($element);

        $this->assertEquals($this->tree, $element->getOwnerTree());
    }

    /**
     * @test
     */
    public function canRemoveChildElement()
    {
        $parent = new \ElementTree\ElementTree();
        $child = new \ElementTree\Element('a');
        $parent->append($child);
        $parent->remove($child);

        $this->assertEquals(array(), $parent->getChildren());
        $this->assertEquals(null, $child->getOwnerTree());
    }

    /**
     * @test
     */
    public function canRemoveSubChildrenElements()
    {
        $parent = new \ElementTree\ElementTree();
        $child = new \ElementTree\Element('a');
        $subchild = new \ElementTree\Element('b');
        $parent->append($child);
        $child->append($subchild);
        $parent->remove($subchild);

        $this->assertEquals(array($child), $parent->getChildren());
        $this->assertEquals($parent, $child->getOwnerTree());
        $this->assertEquals(array(), $child->getChildren());
        $this->assertEquals(null, $subchild->getParent());
    }

    /**
     * @test
     */
    public function doesNotAskTextToRemoveChild()
    {
        $tree = new \ElementTree\ElementTree();
        $text = new \ElementTree\Text('text');
        $tree->append($text);

        $tree->remove(new \ElementTree\Element('b'));

        $this->assertEquals(array($text), $tree->getChildren());
        $this->assertEquals($tree, $text->getOwnerTree());
    }

    /**
     * @test
     */
    public function canReplaceChild()
    {
        $a = new \ElementTree\ElementTree();
        $b = new \ElementTree\Element('b');
        $c = new \ElementTree\Element('c');
        $a->append($b);
        $a->replace($c, $b);

        $this->assertEquals(array($c), $a->getChildren());
    }
}
