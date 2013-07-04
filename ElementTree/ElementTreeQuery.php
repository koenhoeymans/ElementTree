<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

use ElementTree\Specification\ComponentSpecification;

/**
 * @package ElementTree
 */
class ElementTreeQuery implements Query
{
	private $component;

	public function __construct(Component $component)
	{
		$this->component = $component;
	}

	/**
	 * @see \ElementTree\Query::find()
	 */
	public function find(ComponentSpecification $specification)
	{
		$matches = array();
		$this->component->getChildren();
		if ($specification->isSatisfiedBy($this->component))
		{
			$matches[] = $this->component;
		}

		foreach ($this->component->getChildren() as $child)
		{
			$childQuery = new self($child);
			$matches = array_merge($matches, $childQuery->find($specification));
		}

		if ($this->component instanceof Element)
		{
			foreach ($this->component->getAttributes() as $attr)
			{
				$childQuery = new self($attr);
				$matches = array_merge($matches, $childQuery->find($specification));
			}
		}

		return $matches;
	}

	/**
	 * Matches all `Element` components.
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllElements
	 */
	public function allElements(ComponentSpecification $specification = null)
	{
		return new \ElementTree\Specification\AllElements($specification);
	}

	/**
	 * Matches an element when it has an attribute (with given specification).
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\WithAttribute
	 */
	public function withAttribute(ComponentSpecification $specification = null)
	{
		return new \ElementTree\Specification\WithAttribute($specification);
	}

	/**
	 * Matches when the name of the element or attribute is the same.
	 * 
	 * @param string $name
	 * @return \ElementTree\Specification\WithName
	 */
	public function withName($name)
	{
		return new \ElementTree\Specification\WithName($name);
	}

	/**
	 * Matches all `Attribute` components.
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllAttributes
	 */
	public function allAttributes(ComponentSpecification $specification = null)
	{
		return new \ElementTree\Specification\AllAttributes($specification);
	}

	/**
	 * Selects all text components.
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\AllText
	 */
	public function allText(ComponentSpecification $specification = null)
	{
		return new \ElementTree\Specification\AllText($specification);
	}

	/**
	 * Selects components that have a parent element.
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\WithParentElement
	 */
	public function withParentElement(ComponentSpecification $specification = null)
	{
		return new \ElementTree\Specification\WithParentElement($specification);
	}

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
	) {
		$args = func_get_args();
		$andSpec = new \ReflectionClass('\\ElementTree\\Specification\\AndSpecification');

		return $andSpec->newInstanceArgs($args);
	}

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
	) {
		$args = func_get_args();
		$andSpec = new \ReflectionClass('\\ElementTree\\Specification\\OrSpecification');
	
		return $andSpec->newInstanceArgs($args);
	}

	/**
	 * The negation another specification. Selects a component if a specification
	 * does not apply.
	 * 
	 * @param ComponentSpecification $specification
	 * @return \ElementTree\Specification\NotSpecification
	 */
	public function not(ComponentSpecification $specification)
	{
		return new \ElementTree\Specification\NotSpecification($specification);
	}
}