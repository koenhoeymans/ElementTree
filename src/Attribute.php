<?php

namespace ElementTree;

interface Attribute extends Component
{
    /**
     * The attribute name.
     */
    public function getName() : string;

    /**
     * The attribute value.
     */
    public function getValue() : string;

    /**
     * Sets the attribute value.
     */
    public function setValue(string $value);

    /**
     * Don't quote the attribute value when stringified.
     *
     *     checked=true
     */
    public function noQuotes() : void;

    /**
     * Put the attribute value in single quotes when stringified.
     *
     *     foo='bar'
     */
    public function singleQuotes();

    /**
     * Put the attribute value in double quotes when stringified.
     *
     *     foo="bar"
     */
    public function doubleQuotes();
}
