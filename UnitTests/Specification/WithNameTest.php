<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_WithNameTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenElementHasName()
	{
		$withName = new \ElementTree\Specification\WithName('foo');
		$this->assertTrue(
			$withName->isSatisfiedBy(new \ElementTree\ElementTreeElement('foo', 'bar'))
		);
	}

	/**
	 * @test
	 */
	public function isSatisfiedWhenAttributeHasName()
	{
		$withName = new \ElementTree\Specification\WithName('foo');
		$this->assertTrue(
			$withName->isSatisfiedBy(new \ElementTree\ElementTreeAttribute('foo', 'bar'))
		);		
	}
}