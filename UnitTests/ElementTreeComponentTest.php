<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ComponentImp extends \ElementTree\ElementTreeComponent
{
	public function toString() {}
}

class ElementTree_ElementTreeComponentTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->component = new ComponentImp();
	}

	/**
	 * @test
	 */
	public function hasNoParentElementIfNotAppended()
	{
		$this->assertEquals(null, $this->component->getParent());
		$this->assertEquals(false, $this->component->hasParent());
	}

	/**
	 * @test
	 */
	public function hasNoOwnerTreeByDefault()
	{
		$this->assertNull($this->component->getOwnerTree());
	}

	/**
	 * @test
	 */
	public function elementsInWholcomponentCanBeSelectedWithCallback()
	{
		$callback = function(\ElementTree\Component $elementTree) {
			if ($elementTree !== $this->component)
			{
				$this->assertFalse(true);
			}
		};

		$this->component->query($callback);
	}
}