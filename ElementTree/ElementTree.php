<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTree extends Component
{
	/**
	 * @return \ElementTree\Element
	 */
	public function createElement($name)
	{
		$element = new Element($name);
		$this->setOwnerTree($element);

		return $element;
	}

	/**
	 * @return \ElementTree\Text
	 */
	public function createText($value)
	{
		$text = new Text($value);
		$this->setOwnerTree($text);

		return $text;
	}

	/**
	 * @return \ElementTree\Comment
	 */
	public function createComment($value)
	{
		$comment = new Comment($value);
		$this->setOwnerTree($comment);

		return $comment;
	}

	/**
	 * Append a Component as a child. Optionally specifying after which other
	 * child component.
	 * 
	 * @param Component $elementTree
	 * @param Component $after
	 */
	public function append(Component $component, Component $after = null)
	{
		$componentIsElementTree = (get_class($component) === get_class());
		$thisIsElementTree = (get_class($this) === get_class());

		if ($componentIsElementTree)
		{
			foreach (array_reverse($component->getChildren()) as $child)
			{
				$this->append($child, $after);
			}
			return;
		}

		$component->parent = $thisIsElementTree ? null : $this;
		$this->setOwnerTree($component);
		if ($after)
		{
			$key = array_search($after, $this->children);
			array_splice($this->children, $key+1, 0, array($component));
		}
		else
		{
			$this->children[] = $component;
		}
	}

	/**
	 * @param Component $elementTree
	 */
	public function remove(Component $elementTree)
	{
		$children = array();
		foreach ($this->children as $child)
		{
			if ($elementTree !== $child)
			{
				$children[] = $child;
			}
			else
			{
				$child->parent = null;
			}
		}
		$this->children = $children;
	}

	/**
	 * @param Component $newComponent
	 * @param Component $oldComponent
	 */
	public function replace(Component $newComponent, Component $oldComponent)
	{
		if (get_class($newComponent) === __CLASS__)
		{
			$newComponents = $newComponent->getChildren();
		}
		else
		{
			$newComponents = array($newComponent);
		}

		foreach ($newComponents as $component)
		{
			$this->append($component, $oldComponent);
		}

		$this->remove($oldComponent);
	}

	/**
	 * @see \ElementTree\Component::saveXmlStyle()
	 */
	public function saveXmlStyle()
	{
		$content = '';
		foreach ($this->children as $child)
		{
			$content .= $child->saveXmlStyle();
		}

		return $content;
	}

	protected function setOwnerTree(Component $component)
	{
		$component->ownerTree = $this->ownerTree ?: $this;
	}
}