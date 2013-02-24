<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_AndSpecificationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenAllSubspecificationsAreSatisfied()
	{
		$andSpec = new \ElementTree\Filter\AndSpecification(
			new \ElementTree\Filter\ElementByName('a'),
			new \ElementTree\Filter\ElementByName('a')
		);

		$this->assertTrue($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenNotAllSubspecificationsAreSatisfied()
	{
		$andSpec = new \ElementTree\Filter\AndSpecification(
			new \ElementTree\Filter\ElementByName('a'),
			new \ElementTree\Filter\ElementByName('b')
		);

		$this->assertFalse($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}
}