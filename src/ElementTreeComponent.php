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

    protected $nextSibling = null;

    protected $previousSibling = null;

    /**
     * @see \ElementTree\Component::getOwnerTree()
     */
    public function getOwnerTree()
    {
        if ($this->hasParent()) {
            return $this->getParent()->getOwnerTree();
        }

        return;
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
     * @see \ElementTree\Component::getNextSibling()
     */
    public function getNextSibling()
    {
        return $this->nextSibling;
    }

    /**
     * @see \ElementTree\Component::getPreviousSibling()
     */
    public function getPreviousSibling()
    {
        return $this->previousSibling;
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    abstract public function toString();
}
