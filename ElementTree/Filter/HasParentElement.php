<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * @package ElementTree
 */
Class HasParentElement implements ComponentSpecification
{
	private $name;

	public function __construct($name = null)
	{
		$this->name = $name;
	}

	public function isSatisfiedBy(Component $component)
	{
		$parent = $component->getParent();
		if (!$parent)
		{
			return false;
		}
		if (!($parent instanceof \ElementTree\Element))
		{
			return false;
		}
		if (!$this->name)
		{
			return true;
		}
		if ($parent->getName() === $this->name)
		{
			return true;
		}

		return false;
	}
}