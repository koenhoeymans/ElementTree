<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Specification_WithAttributeTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function isSatisfiedWhenElementHasAttribute()
	{
		$div = new \ElementTree\ElementTreeElement('div');
		$div->setAttribute('id', 'foo');

		$withAttr = new \ElementTree\Specification\WithAttribute();

		$this->assertTrue($withAttr->isSatisfiedBy($div));
	}

	/**
	 * @test
	 */
	public function isNotSatisfiedWhenElementHasNoAttributes()
	{
		$div = new \ElementTree\ElementTreeElement('div');

		$withAttr = new \ElementTree\Specification\WithAttribute();

		$this->assertFalse($withAttr->isSatisfiedBy($div));
	}

	/**
	 * @test
	 */
	public function atLeastOneAttributeMustSatisfySubSpecification()
	{
		$div = new \ElementTree\ElementTreeElement('div');
		$div->setAttribute('id', 'foo');
		$div->setAttribute('class', 'bar');

		$subSpec = $this->getMock('\\ElementTree\\Specification\\ComponentSpecification');
		$subSpec
			->expects($this->atLeastOnce())
			->method('isSatisfiedBy')
			->will($this->returnValue(true));

		$withAttr = new \ElementTree\Specification\WithAttribute($subSpec);

		$this->assertTrue($withAttr->isSatisfiedBy($div));
	}

	/**
	 * @test
	 */
	public function notSatisfiedIfNoAttributeSatisfiedSubSpecification()
	{
		$div = new \ElementTree\ElementTreeElement('div');
		$div->setAttribute('id', 'foo');
		$div->setAttribute('class', 'bar');

		$subSpec = $this->getMock('\\ElementTree\\Specification\\ComponentSpecification');
		$subSpec
			->expects($this->atLeastOnce())
			->method('isSatisfiedBy')
			->will($this->returnValue(false));

		$withAttr = new \ElementTree\Specification\WithAttribute($subSpec);

		$this->assertFalse($withAttr->isSatisfiedBy($div));
	}
}