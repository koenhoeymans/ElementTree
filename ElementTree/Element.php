<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Element extends Component
{
	/**
	 * Return the name of the element. Eg, ofted used names for elements
	 * in HTML are `div`, `p` and `blink`.
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Set an attribute with a name and a a value. Eg. in an HTML element
	 * with the name `p` an attribute `class` with the value `important`
	 * can be used to style this paragraph different from others.
	 * 
	 * @param string $name
	 * @param string $value
	 * @return Attribute
	 */
	public function setAttribute($name, $value);

	/**
	 * Returns the value of an attribute.
	 * 
	 * @param string $name
	 * @return string
	 */
	public function getAttributeValue($name);

	/**
	 * Get the list of attributes.
	 * 
	 * @return array
	 */
	public function getAttributes();
}