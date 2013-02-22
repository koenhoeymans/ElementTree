<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * @package ElementTree
 */
Class ElementByName implements ComponentSpecification
{
	private $name;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function isSatisfiedBy(Component $component)
	{
		if ($component instanceof \ElementTree\ElementTreeElement)
		{
			if ($component->getName() === $this->name)
			{
				return true;
			}
		}

		return false;
	}
}