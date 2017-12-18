<?php

namespace ElementTree;

interface Element extends Component
{
    /**
     * Return the name of the element. Eg, ofted used names for elements
     * in HTML are `div`, `p` and `blink`.
     */
    public function getName() : string;

    /**
     * Set an attribute with a name and a a value. Eg. in an HTML element
     * with the name `p` an attribute `class` with the value `important`
     * can be used to style this paragraph different from others.
     */
    public function setAttribute(string $name, string $value) : Attribute;

    /**
     * Remove an attribute, specified by name.
     */
    public function removeAttribute(string $name) : void;

    /**
     * Returns the value of an attribute.
     */
    public function getAttributeValue(string $name) : string;

    /**
     * Whether the element has an attribute with a given name or not.
     */
    public function hasAttribute(string $name) : bool;

    /**
     * Get the list of attributes.
     */
    public function getAttributes() : array;
}
