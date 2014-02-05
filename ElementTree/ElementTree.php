<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTree extends ComposableElementTreeComponent implements ComponentFactory
{
	/**
	 * @see \ElementTree\ElementTreeComponent::getOwnerTree()
	 */
	public function getOwnerTree()
	{
		return $this;
	}

	/**
	 * @see \ElementTree\ComponentFactory::createElement()
	 */
	public function createElement($name)
	{
		return new ElementTreeElement($name);
	}

	/**
	 * @see \ElementTree\ComponentFactory::createText()
	 */
	public function createText($value)
	{
		return new ElementTreeText($value);
	}

	/**
	 * @see \ElementTree\ComponentFactory::createComment()
	 */
	public function createComment($value)
	{
		return new ElementTreeComment($value);
	}

	/**
	 * @param Component $component
	 * @return \ElementTree\ElementTreeQuery
	 */
	public function createQuery(Component $component)
	{
		return new \ElementTree\ElementTreeQuery($component);
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

		return $content;
	}
}