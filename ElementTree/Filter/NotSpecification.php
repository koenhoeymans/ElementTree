<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * @package ElementTree
 */
Class NotSpecification implements ComponentSpecification
{
	private $specification;

	public function __construct(ComponentSpecification $specification)
	{
		$this->specification = $specification;
	}

	public function isSatisfiedBy(Component $component)
	{
		return !$this->specification->isSatisfiedBy($component);
	}
}