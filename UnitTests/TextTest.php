<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_TextTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function hasValue()
	{
		$text = new \ElementTree\ElementTreeText('foo');

		$this->assertEquals('foo', $text->getValue());
	}

	/**
	 * @test
	 */
	public function returnsValueForXmlUse()
	{
		$text = new \ElementTree\ElementTreeText('foo');

		$this->assertEquals('foo', $text->toString());
	}
}