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

	/**
	 * Matches all `Element` components.
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllElements
	 */
	public function allElements(ComponentSpecification $specification = null);

	/**
	 * Matches an element when it has an attribute (with given specification).
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\WithAttribute
	 */
	public function withAttribute(ComponentSpecification $specification = null);

	/**
	 * Matches when the name of the element or attribute is the same.
	 *
	 * @param string $name
	 * @return \ElementTree\Specification\WithName
	 */
	public function withName($name);

	/**
	 * Matches all `Attribute` components.
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllAttributes
	 */
	public function allAttributes(ComponentSpecification $specification = null);

	/**
	 * Selects all text components.
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllText
	 */
	public function allText(ComponentSpecification $specification = null);

	/**
	 * Selects components that have a parent element.
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\WithParentElement
	 */
	public function withParentElement(ComponentSpecification $specification = null);

	/**
	 * Combines specifications. All must succeed for the component to be
	 * selected.
	 *
	 * @param ComponentSpecification $specification1
	 * @param ComponentSpecification $specification2
	 * @return \ElementTree\Specification\AndSpecification
	 */
	public function lAnd(
		ComponentSpecification $specification1, ComponentSpecification $specification2
	);

	/**
	 * Combines specifications. At least one must succeed for the component to be
	 * selected.
	 *
	 * @param ComponentSpecification $specification1
	 * @param ComponentSpecification $specification2
	 * @return \ElementTree\Specification\OrSpecification
	 */
	public function lOr(
		ComponentSpecification $specification1, ComponentSpecification $specification2
	);

	/**
	 * The negation another specification. Selects a component if a specification
	 * does not apply.
	 *
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\NotSpecification
	 */
	public function not(ComponentSpecification $specification);
}