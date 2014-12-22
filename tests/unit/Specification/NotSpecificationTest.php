<?php

namespace ElementTree\Specification;

class NotSpecificationTest extends \PHPUnit_Framework_TestCase
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