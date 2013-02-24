<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
 * This class is callable and used for filtering components that
 * are provided by `ElementTree::query()`.
 * 
 * @package ElementTree
 */
class FilterBuilder implements ComponentSpecification
{
	private $callback;

	private $specification;

	/**
	 * The callback will be invoked whenever there is a matching component.
	 * 
	 * @param Callable $callback
	 */
	public function __construct(
		Callable $callback, ComponentSpecification $specification = null
	) {
		$this->callback = $callback;
		$this->specification = $specification;
	}

	/**
	 * Or-specification. Searches for components that are true for at least
	 * one of the specifications given.
	 * 
	 * @param Callable $callback1
	 * @param Callable $callback2
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function lOr(ComponentSpecification $spec1, ComponentSpecification $spec2)
	{
		$args = func_get_args();
		$orSpec = new \ReflectionClass('\\ElementTree\\Filter\\OrSpecification');
		return new self($this->callback, $orSpec->newInstanceArgs($args));
	}

	/**
	 * And-specification. Searches for components that are true for all
	 * of the specifications given.
	 *
	 * @param Callable $callback1
	 * @param Callable $callback2
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function lAnd(ComponentSpecification $spec1, ComponentSpecification $spec2)
	{
		$args = func_get_args();
		$andSpec = new \ReflectionClass('\\ElementTree\\Filter\\AndSpecification');
		return new self($this->callback, $andSpec->newInstanceArgs($args));
	}

	/**
	 * Searches for elements with a given name.
	 * 
	 * @param string $name
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function element($name)
	{
		return new self($this->callback, new \ElementTree\Filter\ElementByName($name));
	}

	/**
	 * Searches for all `Text` components.
	 * 
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function allText()
	{
		return new self($this->callback, new \ElementTree\Filter\AllText());
	}

	/**
	 * Searches for all `Element` components.
	 * 
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function allElements()
	{
		return new self($this->callback, new \ElementTree\Filter\AllElements());
	}

	/**
	 * Searches for all components that have a parent `Element` with a given name.
	 * 
	 * @param string $name
	 * @return \ElementTree\Filter\FilterBuilder
	 */
	public function hasParentElement($name)
	{
		return new self($this->callback, new \ElementTree\Filter\HasParentElement($name));
	}

	public function __invoke(Component $component)
	{
		if ($this->specification->isSatisfiedBy($component))
		{
			call_user_func($this->callback, $component);
		}
	}

	public function isSatisfiedBy(Component $component)
	{
		if (!isset($this->specification))
		{
			return false;
		}

		return $this->specification->isSatisfiedBy($component);
	}
}