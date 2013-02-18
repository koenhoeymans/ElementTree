<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTreeElement extends ElementTree implements Element

{
	private $name;

	private $attributes = array();

	public function __construct($name)
	{
		$this->name = (string) $name;
	}

	/**
	 * @see \ElementTree\Element::getName()
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @see \ElementTree\Element::setAttribute()
	 */
	public function setAttribute($name, $value)
	{
		$this->attributes[$name] = $value;
	}

	/**
	 * @see \ElementTree\Element::getAttributeValue()
	 */
	public function getAttributeValue($name)
	{
		return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
	}

	/**
	 * @see \ElementTree\Component::toString()
	 */
	public function toString()
	{
		$content = '';
		foreach ($this->children as $child)
		{
			$content .= $child->toString();
		}

		$xml = '<' . $this->name . $this->getAttributes();

		if ($content === '')
		{
			$xml .= ' />';
		}
		else
		{
			$xml .= '>' . $content . '</' . $this->name . '>';
		}

		return $xml;
	}

	private function getAttributes()
	{
		$attr = '';
		foreach ($this->attributes as $name => $value)
		{
			$attr .= ' '
				. $name
				. '='
				. '"'
				. htmlentities($value, ENT_COMPAT, 'UTF-8', false)
				. '"';
		}

		return $attr;
	}
}