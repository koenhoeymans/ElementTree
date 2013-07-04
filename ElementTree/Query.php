<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

use ElementTree\Specification\ComponentSpecification;

/**
 * @package ElementTree
 */
interface Query
{
	/**
	 * Find all components that satisfy a given specification.
	 * 
	 * @param ComponentSpecification $specification
	 * @return array
	 */
	public function find(ComponentSpecification $specification);
}