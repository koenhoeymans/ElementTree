<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_NotSpecificationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenSubspecificationIsNotSatisfied()
	{
		$notSpec = new \ElementTree\Specification\NotSpecification(
			new \ElementTree\Specification\WithName('a')
		);

		$this->assertTrue($notSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('b')));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenSubspecificationIsSatisfied()
	{
		$notSpec = new \ElementTree\Specification\NotSpecification(
			new \ElementTree\Specification\WithName('a')
		);

		$this->assertFalse($notSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
	}
}