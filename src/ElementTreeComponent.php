<?php

namespace ElementTree;

abstract class ElementTreeComponent implements Component
{
    protected $ownerTree = null;

    protected $parent = null;

    protected $children = array();

    protected $nextSibling = null;

    protected $previousSibling = null;

    /**
     * @see \ElementTree\Component::getOwnerTree()
     */
    public function getOwnerTree() : ?ElementTree
    {
        if ($this->hasParent()) {
            return $this->getParent()->getOwnerTree();
        }

        return null;
    }

    /**
     * @see \ElementTree\Component::getParent()
     */
    public function getParent() : ?Component
    {
        return $this->parent;
    }

    /**
     * @see \ElementTree\Component::hasParent()
     */
    public function hasParent() : bool
    {
        return $this->parent ? true : false;
    }

    /**
     * @see \ElementTree\Component::hasChildren()
     */
    public function hasChildren() : bool
    {
        return !empty($this->children);
    }

    /**
     * @see \ElementTree\Component::getChildren()
     */
    public function getChildren() : array
    {
        return $this->children;
    }

    /**
     * @see \ElementTree\Component::getNextSibling()
     */
    public function getNextSibling() : ?Component
    {
        return $this->nextSibling;
    }

    /**
     * @see \ElementTree\Component::getPreviousSibling()
     */
    public function getPreviousSibling() : ?Component
    {
        return $this->previousSibling;
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    abstract public function toString() : string;
}
