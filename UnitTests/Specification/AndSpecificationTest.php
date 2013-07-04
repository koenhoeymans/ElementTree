<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_AndSpecificationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenAllSubspecificationsAreSatisfied()
	{
		$andSpec = new \ElementTree\Specification\AndSpecification(
			new \ElementTree\Specification\AllElements(),
			new \ElementTree\Specification\WithName('a')
		);

		$this->assertTrue($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenNotAllSubspecificationsAreSatisfied()
	{
		$andSpec = new \ElementTree\Specification\AndSpecification(
			new \ElementTree\Specification\AllElements(),
			new \ElementTree\Specification\WithName('b')
		);

		$this->assertFalse($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}
}