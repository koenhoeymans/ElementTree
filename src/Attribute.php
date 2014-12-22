<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Attribute extends Component
{
    /**
     * The attribute name.
     *
     * @return string
     */
    public function getName();

    /**
     * The attribute value.
     *
     * @return string
     */
    public function getValue();

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
