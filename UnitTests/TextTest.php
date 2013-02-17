<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_TextTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->elTree = $this->getMockBuilder('ElementTree\\Component')
			->getMock();
	}
	/**
	 * @test
	 */
	public function hasValue()
	{
		$text = new \ElementTree\Text('foo');

		$this->assertEquals('foo', $text->getValue());
	}

	/**
	 * @test
	 */
	public function returnsValueForXmlUse()
	{
		$text = new \ElementTree\Text('foo');

		$this->assertEquals('foo', $text->saveXmlStyle());
	}
}