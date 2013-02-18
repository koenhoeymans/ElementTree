<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTreeComment extends ElementTreeComponent implements Comment
{
	private $value;

	public function __construct($value)
	{
		$this->value = (string) $value;
	}

	/**
	 * @see \ElementTree\Comment::getValue()
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @see \ElementTree\Comment::setValue()
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}

	/**
	 * `<!-- comment -->`
	 * 
	 * @see ElementTree\Component::saveXmlStyle()
	 */
	public function saveXmlStyle()
	{
		return '<!--' . $this->value . '-->';
	}
}