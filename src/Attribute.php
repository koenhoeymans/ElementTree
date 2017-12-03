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
     *
     * @param string $value
     */
    public function setValue($value);

    /**
     * Don't quote the attribute value when stringified.
     *
     *     checked=true
     */
    public function noQuotes();

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
