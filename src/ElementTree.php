<?php

namespace ElementTree;

class ElementTree extends ComposableElementTreeComponent implements ComponentFactory
{
    /**
     * @see \ElementTree\ElementTreeComponent::getOwnerTree()
     */
    public function getOwnerTree() : ?ElementTree
    {
        return $this;
    }

    /**
     * @see \ElementTree\ComponentFactory::createElement()
     */
    public function createElement($name) : Element
    {
        return new ElementTreeElement($name);
    }

    /**
     * @see \ElementTree\ComponentFactory::createText()
     */
    public function createText($value) : Text
    {
        return new ElementTreeText($value);
    }

    /**
     * @see \ElementTree\ComponentFactory::createComment()
     */
    public function createComment($value) : Comment
    {
        return new ElementTreeComment($value);
    }

    public function createQuery(Component $component) : ElementTreeQuery
    {
        return new \ElementTree\ElementTreeQuery($component);
    }

    public function toString() : string
    {
        $content = '';
        foreach ($this->children as $child) {
            $content .= $child->toString();
        }

        return $content;
    }
}
