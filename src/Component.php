<?php

namespace ElementTree;

abstract class Component
{
    protected $ownerTree = null;

    protected $parent = null;

    protected $children = array();

    protected $nextSibling = null;

    protected $previousSibling = null;

    /**
     * Get the `OwnerTree` to which a `Component` belongs. If the component
     * was not added to a tree, or added to another `Component` that has no
     * `OwnerTree` this method will return `null`.
     */
    public function getOwnerTree() : ?ElementTree
    {
        if ($this->hasParent()) {
            return $this->getParent()->getOwnerTree();
        }

        return null;
    }

    /**
     * Return the parent `Component` to which this `Component` was added to.
     */
    public function getParent() : ?Component
    {
        return $this->parent;
    }

    /**
     * Whether this `Component` has a parent or not.
     */
    public function hasParent() : bool
    {
        return $this->parent ? true : false;
    }

    /**
     * Whether this `Component` has another `Component` added to it.
     */
    public function hasChildren() : bool
    {
        return !empty($this->children);
    }

    /**
     * Returns all `Component`s that were added to this `Component`. Only
     * direct subcomponents are returned.
     */
    public function getChildren() : array
    {
        return $this->children;
    }

    /**
     * Get the next `Component` that was added after this `Component` to the
     * parent.
     */
    public function getNextSibling() : ?Component
    {
        return $this->nextSibling;
    }

    /**
     * Get the previous `Component` that was added after this `Component` to
     * the parent.
     */
    public function getPreviousSibling() : ?Component
    {
        return $this->previousSibling;
    }

    /**
     * Get a string representation.
     */
    abstract public function toString() : string;
}
