<?php

namespace ElementTree;

class Element extends ComposableComponent implements Appendable
{
    private $name;

    private $attributes = array();

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @see \ElementTree\Appendable::appendTo()
     */
    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * Get the name of the `Element`.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set an attribte by name and value.
     */
    public function setAttribute($name, $value) : Attribute
    {
        $attr = new Attribute($name, $value);
        $attr->parent = $this;
        $this->attributes[$name] = $attr;

        return $attr;
    }

    /**
     * Remove an attribute by name.
     */
    public function removeAttribute($name) : void
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * Get the value of an attribute.
     */
    public function getAttributeValue($name) : string
    {
        return isset($this->attributes[$name])
            ? $this->attributes[$name]->getValue()
            : null;
    }

    /**
     * Whether this `Element` has an attribute known by `$name`.
     */
    public function hasAttribute(string $name) : bool
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Get alle the `Attribute` objects.
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
