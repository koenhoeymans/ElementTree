<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * @package ElementTree
 */
Class AllAttributes implements ComponentSpecification
{
	public function isSatisfiedBy(Component $component)
	{
		return ($component instanceof \ElementTree\Attribute);
	}
}