<?php

require_once dirname(__FILE__)
	. DIRECTORY_SEPARATOR . '..'
	. DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_Filter_FilterBuilderTest extends PHPUnit_Framework_TestCase
{
	public function createQBuilderWithCallback($callback)
	{
		return new \ElementTree\Filter\FilterBuilder($callback);
	}

	/**
	 * @test
	 */
	public function onlyWhenSpecificationsAreSatisfiedByComponentPassesComponentToCallback()
	{
		$callback = function(ElementTree\ElementTreeElement $el) {
			if ($el->getName() === 'b') $this->fail();
		};
		$specification = new \ElementTree\Filter\ElementByName('a');

		$filter = new \ElementTree\Filter\FilterBuilder($callback, $specification);

		$filter(new \ElementTree\ElementTreeElement('a'));
		$filter(new \ElementTree\ElementTreeElement('b'));
	}
}