<?php

namespace ElementTree;

class ElementTree extends ComposableComponent implements ComponentFactory
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
        return new Element($name);
    }

    /**
     * @see \ElementTree\ComponentFactory::createText()
     */
    public function createText($value) : Text
    {
        return new Text($value);
    }

    /**
     * @see \ElementTree\ComponentFactory::createComment()
     */
    public function createComment($value) : Comment
    {
        return new Comment($value);
    }

    public function createQuery(Component $component) : Query
    {
        return new Query($component);
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
