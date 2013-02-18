<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTreeText extends ElementTreeComponent implements Text
{
	private $value;

	public function __construct($value)
	{
		$this->value = (string) $value;
	}

	/**
	 * @see \ElementTree\Text::getValue()
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @see \ElementTree\Text::setValue()
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}

	/**
	 * @see \ElementTree\Component::toString()
	 */
	public function toString()
	{
		return htmlentities($this->value, ENT_NOQUOTES, 'UTF-8', false);
	}
}