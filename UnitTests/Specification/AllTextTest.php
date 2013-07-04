<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_AllTextTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenGivenTextComponent()
	{
		$allText = new \ElementTree\Specification\AllText();
		$this->assertTrue(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeText('a'))
		);
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenGivenElementComponent()
	{
		$allText = new \ElementTree\Specification\AllText();
		$this->assertFalse(
			$allText->isSatisfiedBy(new \ElementTree\ElementTreeElement('a'))
		);
	}
}