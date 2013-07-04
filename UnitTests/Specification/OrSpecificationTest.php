<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_OrSpecificationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenAtLeastOneSubspecificationsIsSatisfied()
	{
		$orSpec = new \ElementTree\Specification\OrSpecification(
			new \ElementTree\Specification\WithName('a'),
			new \ElementTree\Specification\WithName('b')
		);

		$this->assertTrue($orSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenAllSubspecificationsAreNotSatisfied()
	{
		$orSpec = new \ElementTree\Specification\OrSpecification(
			new \ElementTree\Specification\WithName('b'),
			new \ElementTree\Specification\WithName('c')
		);

		$this->assertFalse($orSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}
}