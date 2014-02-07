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

		if ($after)
		{
			$key = array_search($after, $this->children, true)+1;
		}
		else
		{
			$key = count($this->children);
		}

		$this->insert($component, $key);
	}

	/**
	 * @see \ElementTree\Composable::insertAfter()
	 */
	public function insertAfter(Appendable $component, Appendable $after)
	{
		$component->parent = $this;
		$key = array_search($after, $this->children, true)+1;
		$this->insert($component, $key);
	}

	/**
	 * @see \ElementTree\Composable::insertBefore()
	 */
	public function insertBefore(Appendable $component, Appendable $before)
	{
		$component->parent = $this;
		$key = array_search($before, $this->children, true);
		$this->insert($component, $key);
	}

	private function insert(Appendable $component, $position)
	{
		array_splice($this->children, $position, 0, array($component));

		if (isset($this->children[$position-1]))
		{
			$this->children[$position-1]->nextSibling = $component;
			$component->previousSibling = $this->children[$position-1];
		}
		if (isset($this->children[$position+1]))
		{
			$this->children[$position+1]->previousSibling = $component;
			$component->nextSibling = $this->children[$position+1];
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
		$numberOfChildren = count($this->children);
		foreach ($this->children as $key => $child)
		{
			if ($component === $child)
			{
				if ($key !== 0)
				{
					if ($key === $numberOfChildren-1)
					{
						$this->children[$key-1]->nextSibling = null;
					}
					else
					{
						$this->children[$key-1]->nextSibling = $this->children[$key+1];
					}
					if (isset($this->children[$key+1]))
					{
						$this->children[$key+1]->previousSibling = $this->children[$key-1];
					}
				}
				elseif ($numberOfChildren > 1)
				{
					$this->children[1]->previousSibling = null;
				}

				unset($this->children[$key]);
				$this->children = array_values($this->children);
				$child->parent = null;
				$child->ownerTree = null;
				$child->previousSibling = null;
				$child->nextSibling = null;

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
}