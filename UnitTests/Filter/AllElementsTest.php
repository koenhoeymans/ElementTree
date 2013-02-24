<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_AllElementsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenGivenElementComponent()
	{
		$allText = new \ElementTree\Filter\AllElements();
		$this->assertTrue(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeElement('a'))
		);
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenGivenElementComponent()
	{
		$allText = new \ElementTree\Filter\AllElements();
		$this->assertFalse(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeText('a'))
		);
	}
}