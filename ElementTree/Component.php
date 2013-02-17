<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
abstract class Component
{
	protected $ownerTree = null;

	protected $parent = null;

	protected $children = array();

	/**
	 * @return \ElementTree\ElementTree|null
	 */
	public function getOwnerTree()
	{
		return $this->ownerTree;
	}

	/**
	 * @return \ElementTree\ElementTree\Component|null
	 */
	public function getParent()
	{
		return $this->parent;
	}

	public function hasParent()
	{
		return $this->parent ? true : false;
	}

	/**
	 * @return boolean
	 */
	public function hasChildren()
	{
		return !empty($this->children);
	}

	/**
	 * @return array:
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * Save contents of the component compatible with XML.
	 */
	abstract public function saveXmlStyle();

	/**
	 * Iterates through this component and its children recursively. Each
	 * is passed as a paramater into the callback.
	 * 
	 * @param callable $callback
	 */
	public function query(callable $callback)
	{
		$callback($this);
		foreach ($this->children as $child)
		{
			$child->query($callback);			
		}
	}
}