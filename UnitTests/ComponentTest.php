<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ComponentImp extends \ElementTree\Component
{
	public function saveXmlStyle() {}
}

class ElementTree_ComponentTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->eTree = new ComponentImp();
	}

	/**
	 * @test
	 */
	public function hasNoParentElementIfNotAppended()
	{
		$this->assertEquals(null, $this->eTree->getParent());
		$this->assertEquals(false, $this->eTree->hasParent());
	}

	/**
	 * @test
	 */
	public function elementsInWholeTreeCanBeSelectedWithCallback()
	{
		$callback = function(\ElementTree\Component $elementTree) {
			if ($elementTree !== $this->eTree)
			{
				$this->assertFalse(true);
			}
		};

		$this->eTree->query($callback);
	}

	/**
	 * @test
	 */
	public function hasNoOwnerTreeByDefault()
	{
		$this->assertNull($this->eTree->getOwnerTree());
	}
}