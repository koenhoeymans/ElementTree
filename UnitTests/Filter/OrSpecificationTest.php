<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_OrSpecificationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenAtLeastOneSubspecificationsIsSatisfied()
	{
		$orSpec = new \ElementTree\Filter\OrSpecification(
			new \ElementTree\Filter\ElementByName('a'),
			new \ElementTree\Filter\ElementByName('b')
		);

		$this->assertTrue($orSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenAllSubspecificationsAreNotSatisfied()
	{
		$orSpec = new \ElementTree\Filter\OrSpecification(
			new \ElementTree\Filter\ElementByName('b'),
			new \ElementTree\Filter\ElementByName('c')
		);

		$this->assertFalse($orSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}
}