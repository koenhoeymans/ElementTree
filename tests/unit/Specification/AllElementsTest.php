<?php

namespace ElementTree\Specification;

class AllElementsTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenGivenElementComponent()
	{
		$allText = new \ElementTree\Specification\AllElements();
		$this->assertTrue(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeElement('a'))
		);
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenGivenElementComponent()
	{
		$allText = new \ElementTree\Specification\AllElements();
		$this->assertFalse(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeText('a'))
		);
	}
}