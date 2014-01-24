<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Composable
{
	/**
	 * Appends an appendable component as a child. Optionally specifying
	 * after which other child component.
	 *
	 * @param Appendable $component
	 * @param Appendable $after
	 */
	public function append(Appendable $component, Appendable $after = null);

	/**
	 * Removes a subcomponent.
	 * 
	 * @param Appendable $component
	 */
	public function remove(Appendable $component);

	/**
	 * Replaces a subcomponent by another one.
	 * 
	 * @param Appendable $newComponent
	 * @param Appendable $oldComponent
	 */
	public function replace(Appendable $newComponent, Appendable $oldComponent);
}