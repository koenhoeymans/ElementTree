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
	 * Appends a Component as a child. Optionally specifying after which other
	 * child component.
	 *
	 * @param Component $component
	 * @param Component $after
	 */
	public function append(Component $component, Component $after = null);

	/**
	 * Removes a subcomponent.
	 * 
	 * @param Component $component
	 */
	public function remove(Component $component);

	/**
	 * Replaces a subcomponent by another one.
	 * 
	 * @param Component $newComponent
	 * @param Component $oldComponent
	 */
	public function replace(Component $newComponent, Component $oldComponent);
}