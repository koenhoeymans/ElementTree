<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * @package ElementTree
 */
Class AllElements implements ComponentSpecification
{
	public function isSatisfiedBy(Component $component)
	{
		return ($component instanceof \ElementTree\Element);
	}
}