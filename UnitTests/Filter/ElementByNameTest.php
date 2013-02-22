<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_ElementByNameTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->elByName = new \ElementTree\Filter\ElementByName('a');
	}

	public function createElement($name)
	{
		return new \ElementTree\ElementTreeElement($name);
	}

	/**
	 * @test
	 */
	public function isSatisfiedByElementWithMatchingName()
	{
		$element = $this->createElement('a');

		$this->assertTrue($this->elByName->isSatisfiedBy($element));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenElementHasDifferentName()
	{
		$element = $this->createElement('b');

		$this->assertFalse($this->elByName->isSatisfiedBy($element));
	}
}