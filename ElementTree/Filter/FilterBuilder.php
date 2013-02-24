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
class FilterBuilder
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

	public function __invoke(Component $component)
	{
		if ($this->specification->isSatisfiedBy($component))
		{
			call_user_func($this->callback, $component);
		}
	}
}