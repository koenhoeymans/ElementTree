<?php

namespace ElementTree;

class ElementTreeElement extends ComposableElementTreeComponent implements
    Element,
    Appendable
{
    private $name;

    private $attributes = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * @see \ElementTree\Element::getName()
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @see \ElementTree\Element::setAttribute()
     */
    public function setAttribute($name, $value) : Attribute
    {
        $attr = new ElementTreeAttribute($name, $value);
        $attr->parent = $this;
        $this->attributes[$name] = $attr;

        return $attr;
    }

    /**
     * @see \ElementTree\Element::removeAttribute()
     */
    public function removeAttribute($name) : void
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * @see \ElementTree\Element::getAttributeValue()
     */
    public function getAttributeValue($name) : string
    {
        return isset($this->attributes[$name])
            ? $this->attributes[$name]->getValue()
            : null;
    }

    /**
     * @see \ElementTree\Element::hasAttribute()
     */
    public function hasAttribute(string $name) : bool
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @see \ElementTree\Element::getAttributes()
     */
    public function getAttributes() : array
    {
        return array_values($this->attributes);
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    public function toString() : string
    {
        $content = '';
        foreach ($this->children as $child) {
            $content .= $child->toString();
        }

        $xml = '<' . $this->name . $this->getAttributesAsString();

        if ($content === '') {
            $xml .= ' />';
        } else {
            $xml .= '>' . $content . '</' . $this->name . '>';
        }

        return $xml;
    }

    private function getAttributesAsString() : string
    {
        $attr = '';
        foreach ($this->attributes as $name => $attribute) {
            $attr .= ' ' . $attribute->toString();
        }

        return $attr;
    }
}
