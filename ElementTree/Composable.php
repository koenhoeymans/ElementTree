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
	 * Inserts an appendable component as a child after another component. 
	 * 
	 * @param Appendable $component
	 * @param Appendable $after
	 */
	public function insertAfter(Appendable $component, Appendable $after);

	/**
	 * Inserts an appendable component as a child before another component.
	 * 
	 * @param Appendable $component
	 * @param Appendable $before
	 */
	public function insertBefore(Appendable $component, Appendable $before);

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