<?php

namespace ElementTree;

class ElementTreeTest extends \PHPUnit_Framework_TestCase
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
			$this->tree->createElement('foo') instanceof \ElementTree\ElementTreeElement
		);
	}
	
	/**
	 * @test
	 */
	public function createsText()
	{
		$this->assertTrue(
			$this->tree->createText('foo') instanceof \ElementTree\ElementTreeText
		);
	}

	/**
	 * @test
	 */
	public function createsComment()
	{
		$this->assertTrue(
			$this->tree->createComment('foo') instanceof \ElementTree\ElementTreeComment
		);
	}

	/**
	 * @test
	 */
	public function isParentOfAppended()
	{
		$element = new \ElementTree\ElementTreeElement('a');
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
		$element = new \ElementTree\ElementTreeElement('p');
		$this->tree->append($element);

		$this->assertEquals($this->tree, $element->getOwnerTree());
	}

	/**
	 * @test
	 */
	public function canRemoveChildElement()
	{
		$parent = new \ElementTree\ElementTree();
		$child = new \ElementTree\ElementTreeElement('a');
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
		$child = new \ElementTree\ElementTreeElement('a');
		$subchild = new \ElementTree\ElementTreeElement('b');
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
		$text = new \ElementTree\ElementTreeText('text');
		$tree->append($text);

		$tree->remove(new \ElementTree\ElementTreeElement('b'));

		$this->assertEquals(array($text), $tree->getChildren());
		$this->assertEquals($tree, $text->getOwnerTree());
	}

	/**
	 * @test
	 */
	public function canReplaceChild()
	{
		$a = new \ElementTree\ElementTree();
		$b = new \ElementTree\ElementTreeElement('b');
		$c = new \ElementTree\ElementTreeElement('c');
		$a->append($b);
		$a->replace($c, $b);

		$this->assertEquals(array($c), $a->getChildren());
	}
}