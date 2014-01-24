<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
abstract class ComposableElementTreeComponent
	extends ElementTreeComponent
	implements Composable
{
	/**
	 * @see \ElementTree\Composable::append()
	 */
	public function append(Appendable $component, Appendable $after = null)
	{
		$component->parent = $this;
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
	public function remove(Appendable $component)
	{
		if (!$this->removeChild($component))
		{
			$this->removeChildInChildren($component);
		}
	}

	/**
	 * @see \ElementTree\Composable::replace()
	 */
	public function replace(Appendable $newComponent, Appendable $oldComponent)
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

	protected function setOwnerTree(Component $component)
	{
		$component->ownerTree = $this->ownerTree ?: $this;
	}
}