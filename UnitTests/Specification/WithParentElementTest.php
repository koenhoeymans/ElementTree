<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_WithParentElementTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenComponentHasParentElement()
	{
		$element = new \ElementTree\ElementTreeElement('foo');
		$text = new \ElementTree\ElementTreeText('bar');
		$element->append($text);

		$withParentEl = new \ElementTree\Specification\WithParentElement();

		$this->assertTrue($withParentEl->isSatisfiedBy($text));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenComponentDoesntHaveParent()
	{
		$text = new \ElementTree\ElementTreeText('bar');

		$withParentEl = new \ElementTree\Specification\WithParentElement();

		$this->assertFalse($withParentEl->isSatisfiedBy($text));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenParentIsntAnElement()
	{
		$tree = new \ElementTree\ElementTree();
		$text = new \ElementTree\ElementTreeText('bar');
		$tree->append($text);

		$withParentEl = new \ElementTree\Specification\WithParentElement();

		$this->assertFalse($withParentEl->isSatisfiedBy($text));
	}

	/**
	 * @test
	 */
	public function canAcceptSubSpecification()
	{
		$element = new \ElementTree\ElementTreeElement('foo');
		$text = new \ElementTree\ElementTreeText('bar');
		$element->append($text);

		$subSpec = $this->getMock('\\ElementTree\\Specification\\ComponentSpecification');
		$withParentEl = new \ElementTree\Specification\WithParentElement($subSpec);

		$subSpec
			->expects($this->atLeastOnce())
			->method('isSatisfiedBy')
			->with($element)
			->will($this->returnValue(true));

		$this->assertTrue($withParentEl->isSatisfiedBy($text));
	}
}