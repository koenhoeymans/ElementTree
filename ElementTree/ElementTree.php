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
	 * @see \ElementTree\ComponentFactory::createElement()
	 */
	public function createElement($name)
	{
		$element = new ElementTreeElement($name);
		$this->setOwnerTree($element);

		return $element;
	}

	/**
	 * @see \ElementTree\ComponentFactory::createText()
	 */
	public function createText($value)
	{
		$text = new ElementTreeText($value);
		$this->setOwnerTree($text);

		return $text;
	}

	/**
	 * @see \ElementTree\ComponentFactory::createComment()
	 */
	public function createComment($value)
	{
		$comment = new ElementTreeComment($value);
		$this->setOwnerTree($comment);

		return $comment;
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