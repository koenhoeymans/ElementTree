<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
class ElementTree extends ElementTreeComponent implements ComponentFactory, Composable
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
	 * @see \ElementTree\Composable::append()
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
			$key = array_search($after, $this->children, true);
			array_splice($this->children, $key+1, 0, array($component));
		}
		else
		{
			$this->children[] = $component;
		}
	}

	/**
	 * @see \ElementTree\Composable::remove()
	 */
	public function remove(Component $component)
	{
		if (!$this->removeChild($component))
		{
			$this->removeChildInChildren($component);
		}
	}

	private function removeChild(Component $component)
	{
		foreach ($this->children as $key => $child)
		{
			if ($component === $child)
			{
				unset($this->children[$key]);
				$this->children = array_values($this->children);
				$child->parent = null;
				$child->ownerTree = null;
				return true;
			}
		}

		return false;
	}

	private function removeChildInChildren(Component $component)
	{
		foreach ($this->children as $child)
		{
			if (get_class($child) === get_class()
					|| in_array(get_class(), class_parents(get_class($child)))
			) {
				$child->remove($component);
			}
		}
	}

	/**
	 * @see \ElementTree\Composable::replace()
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

	protected function setOwnerTree(Component $component)
	{
		$component->ownerTree = $this->ownerTree ?: $this;
	}
}