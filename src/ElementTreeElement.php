<?php

namespace ElementTree;

class ElementTreeElement extends ComposableElementTreeComponent implements
    Element,
    Appendable
{
    private $name;

    private $attributes = array();

    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * @see \ElementTree\Element::getName()
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @see \ElementTree\Element::setAttribute()
     */
    public function setAttribute($name, $value)
    {
        $attr = new ElementTreeAttribute($name, $value);
        $attr->parent = $this;
        $this->attributes[$name] = $attr;

        return $attr;
    }

    /**
     * @see \ElementTree\Element::removeAttribute()
     */
    public function removeAttribute($name)
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * @see \ElementTree\Element::getAttributeValue()
     */
    public function getAttributeValue($name)
    {
        return isset($this->attributes[$name])
            ? $this->attributes[$name]->getValue()
            : null;
    }

    /**
     * @see \ElementTree\Element::hasAttribute()
     */
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @see \ElementTree\Element::getAttributes()
     */
    public function getAttributes()
    {
        return array_values($this->attributes);
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    public function toString()
    {
        $content = '';
        foreach ($this->children as $child) {
            $content .= $child->toString();
        }

        $xml = '<'.$this->name.$this->getAttributesAsString();

        if ($content === '') {
            $xml .= ' />';
        } else {
            $xml .= '>'.$content.'</'.$this->name.'>';
        }

        return $xml;
    }

    private function getAttributesAsString()
    {
        $attr = '';
        foreach ($this->attributes as $name => $attribute) {
            $attr .= ' '.$attribute->toString();
        }

        return $attr;
    }
}
