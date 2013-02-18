<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
abstract class ElementTreeComponent implements Component
{
	protected $ownerTree = null;

	protected $parent = null;

	protected $children = array();

	/**
	 * @see \ElementTree\Component::getOwnerTree()
	 */
	public function getOwnerTree()
	{
		return $this->ownerTree;
	}

	/**
	 * @see \ElementTree\Component::getParent()
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @see \ElementTree\Component::hasParent()
	 */
	public function hasParent()
	{
		return $this->parent ? true : false;
	}

	/**
	 * @see \ElementTree\Component::hasChildren()
	 */
	public function hasChildren()
	{
		return !empty($this->children);
	}

	/**
	 * @see \ElementTree\Component::getChildren()
	 */
	public function getChildren()
	{
		return $this->children;
	}

	/**
	 * @see \ElementTree\Component::saveXmlStyle()
	 */
	abstract public function saveXmlStyle();

	/**
	 * @see \ElementTree\Component::query()
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