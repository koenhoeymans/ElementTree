<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_ElementTreeTest extends PHPUnit_Framework_TestCase
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
	public function isNotParentOfAppended()
	{
		$element = new \ElementTree\Element('a');
		$this->tree->append($element);

		$this->assertEquals(null, $element->getParent());
	}

	/**
	 * @test
	 */
	public function appendsAllChildrenOfAppendedComponentTreeAndDiscardsTree()
	{
		$elementTree = new \ElementTree\ElementTree();
		$element = new \ElementTree\Element('a');
		$elementTree->append($element);

		$this->tree->append($elementTree);

		$this->assertEquals(array($element), $this->tree->getChildren());
	}

	/**
	 * @test
	 */
	public function addsOwnerTreeToCreatedComponent()
	{
		$element = $this->tree->createElement('a');

		$this->assertEquals($this->tree, $element->getOwnerTree());
	}

	/**
	 * @test
	 */
	public function addsOwnerTreeToAppendedComponent()
	{
		$element = new \ElementTree\Element('a');
		$this->tree->append($element);

		$this->assertEquals($this->tree, $element->getOwnerTree());
	}
}