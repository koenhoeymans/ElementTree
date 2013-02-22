<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Filter;

use ElementTree\Component;

/**
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

	public function element($name)
	{
		return new self($this->callback, new \ElementTree\Filter\ElementByName($name));
	}

	public function allText()
	{
		return new self($this->callback, new \ElementTree\Filter\AllText());
	}

	public function __invoke(Component $component)
	{
		if ($this->specification->isSatisfiedBy($component))
		{
			call_user_func($this->callback, $component);
		}
	}
}