<?php

namespace ElementTree;

abstract class ComposableElementTreeComponent extends ElementTreeComponent implements Composable
{
    /**
     * @see \ElementTree\Composable::append()
     */
    public function append(Appendable $component) : void
    {
        $this->insert($component, count($this->children));
    }

    /**
     * @see \ElementTree\Composable::insertAfter()
     */
    public function insertAfter(Appendable $component, Appendable $after) : void
    {
        $key = array_search($after, $this->children, true) + 1;
        $this->insert($component, $key);
    }

    /**
     * @see \ElementTree\Composable::insertBefore()
     */
    public function insertBefore(Appendable $component, Appendable $before) : void
    {
        $key = array_search($before, $this->children, true);
        $this->insert($component, $key);
    }

    private function insert(Appendable $component, $position) : void
    {
        $this->removeFromPreviousOwner($component);

        $component->parent = $this;

        array_splice($this->children, $position, 0, array($component));

        if (isset($this->children[$position - 1])) {
            $this->children[$position - 1]->nextSibling = $component;
            $component->previousSibling = $this->children[$position - 1];
        }
        if (isset($this->children[$position + 1])) {
            $this->children[$position + 1]->previousSibling = $component;
            $component->nextSibling = $this->children[$position + 1];
        }
    }

    /**
     * @see \ElementTree\Composable::remove()
     */
    public function remove(Appendable $component) : void
    {
        $parent = $component->getParent();
        if ($parent) {
            $parent->removeChild($component);
        }
    }

    /**
     * @see \ElementTree\Composable::replace()
     */
    public function replace(Appendable $newComponent, Appendable $oldComponent) : void
    {
        $parent = $oldComponent->getParent();
        if (!$parent) {
            return;
        }
        $parent->insertAfter($newComponent, $oldComponent);
        $parent->remove($oldComponent);
    }

    private function removeChild(Component $component)
    {
        foreach ($this->children as $key => $child) {
            if ($component === $child) {
                unset($this->children[$key]);
                $this->children = array_values($this->children);
                $child->parent = null;
                $child->ownerTree = null;
                $child->previousSibling = null;
                $child->nextSibling = null;

                if (isset($this->children[$key])) {
                    $this->children[$key]->previousSibling = isset($this->children[$key - 1])
                        ? $this->children[$key - 1]
                        : null;
                }
                if (isset($this->children[$key - 1])) {
                    $this->children[$key - 1]->nextSibling = isset($this->children[$key])
                        ? $this->children[$key]
                        : null;
                }

                break;
            }
        }
    }

    private function removeFromPreviousOwner(Component $component)
    {
        if ($component->hasParent()) {
            $component->getParent()->remove($component);
        }
    }
}
