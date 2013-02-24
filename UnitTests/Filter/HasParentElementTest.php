<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_HasParentElementTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->parentElNameA = new \ElementTree\Filter\HasParentElement('a');
	}

	public function createElement($name)
	{
		return new \ElementTree\ElementTreeElement($name);
	}

	/**
	 * @test
	 */
	public function isSatisfiedWhenComponentHasParentElementWithMatchingName()
	{
		$element1 = $this->createElement('a');
		$element2 = $this->createElement('b');
		$element1->append($element2);

		$this->assertTrue($this->parentElNameA->isSatisfiedBy($element2));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenParentElementHasDifferentName()
	{
		$element1 = $this->createElement('c');
		$element2 = $this->createElement('b');
		$element1->append($element2);

		$this->assertFalse($this->parentElNameA->isSatisfiedBy($element2));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenComponentHasNoParentElement()
	{
		$element = $this->createElement('a');

		$this->assertFalse($this->parentElNameA->isSatisfiedBy($element));
	}

	/**
	 * @test
	 */
	public function isSatisfiedWhenComponentHasAnyParentElementWhenNameNotSpecified()
	{
		$anyParentEl = new \ElementTree\Filter\HasParentElement();
		$element = $this->createElement('a');
		
		$this->assertFalse($anyParentEl->isSatisfiedBy($element));
	}
}